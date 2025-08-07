<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TypescriptTransformCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:typescript-transform-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Checks if `typescript:transform` command is up-to-date with the types in the app.";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTypesFile = resource_path('js/types/generated.d.ts');
        $generatedTypesFile = resource_path(sprintf('typescript-transform-check-%s.d.ts', uniqid()));

        $this->info('Generating typescript:transform types...');

        try {
            $this->call('typescript:transform', [
            '--silent' => true,
            '--output' => basename($generatedTypesFile)
            ]);
        } catch (\Throwable) {
            $this->warn('typescript:transform failed, but continuing...');
        }

        if (!file_exists($currentTypesFile)) {
            $this->error("The types file '{$currentTypesFile}' does not exist.");
            $this->line("Please generate it for the first time by running 'php artisan typescript:transform' and commit the result.");
            return 1;
        }

        if (file_exists($generatedTypesFile) && file_get_contents($currentTypesFile) !== file_get_contents($generatedTypesFile)) {
            $this->error('Generated TypeScript types are out of sync with the repository.');
            $this->line("Please run 'php artisan typescript:transform' locally and commit the changes.");
            $this->line('--- Differences ---');
            $diff = shell_exec(sprintf('diff -u %s %s', escapeshellarg($currentTypesFile), escapeshellarg($generatedTypesFile)));
            $this->line($diff ?: '(No diff output)');
            @unlink($generatedTypesFile);
            return 1;
        }

        $this->info('✅ TypeScript types are up to date.');
        @unlink($generatedTypesFile);
        return 0;
    }
}
