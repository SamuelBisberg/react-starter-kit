<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'phone' => 'השדה :attribute חייב להיות מספר טלפון תקף.',

    'accepted' => 'השדה :attribute חייב להיות מאושר.',
    'accepted_if' => 'השדה :attribute חייב להיות מאושר כאשר :other הוא :value.',
    'active_url' => 'השדה :attribute חייב להיות כתובת URL תקפה.',
    'after' => 'השדה :attribute חייב להיות תאריך אחרי :date.',
    'after_or_equal' => 'השדה :attribute חייב להיות תאריך אחרי או שווה ל-:date.',
    'alpha' => 'השדה :attribute חייב להכיל רק אותיות.',
    'alpha_dash' => 'השדה :attribute חייב להכיל רק אותיות, מספרים, מקפים וקווים תחתונים.',
    'alpha_num' => 'השדה :attribute חייב להכיל רק אותיות ומספרים.',
    'any_of' => 'השדה :attribute אינו תקף.',
    'array' => 'השדה :attribute חייב להיות מערך.',
    'ascii' => 'השדה :attribute חייב להכיל רק תווים אלפנומריים וסימנים חד-בייטיים.',
    'before' => 'השדה :attribute חייב להיות תאריך לפני :date.',
    'before_or_equal' => 'השדה :attribute חייב להיות תאריך לפני או שווה ל-:date.',
    'between' => [
        'array' => 'השדה :attribute חייב להכיל בין :min ל-:max פריטים.',
        'file' => 'השדה :attribute חייב להיות בין :min ל-:max קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות בין :min ל-:max.',
        'string' => 'השדה :attribute חייב להיות בין :min ל-:max תווים.',
    ],
    'boolean' => 'השדה :attribute חייב להיות אמת או שקר.',
    'can' => 'השדה :attribute מכיל ערך לא מורשה.',
    'confirmed' => 'אישור השדה :attribute אינו תואם.',
    'contains' => 'השדה :attribute חסר ערך נדרש.',
    'current_password' => 'הסיסמה שגויה.',
    'date' => 'השדה :attribute חייב להיות תאריך תקף.',
    'date_equals' => 'השדה :attribute חייב להיות תאריך שווה ל-:date.',
    'date_format' => 'השדה :attribute חייב להתאים לפורמט :format.',
    'decimal' => 'השדה :attribute חייב להכיל :decimal מקומות עשרוניים.',
    'declined' => 'השדה :attribute חייב להיות דחוי.',
    'declined_if' => 'השדה :attribute חייב להיות דחוי כאשר :other הוא :value.',
    'different' => 'השדה :attribute ו-:other חייבים להיות שונים.',
    'digits' => 'השדה :attribute חייב להיות :digits ספרות.',
    'digits_between' => 'השדה :attribute חייב להיות בין :min ל-:max ספרות.',
    'dimensions' => 'השדה :attribute מכיל מימדי תמונה לא תקפים.',
    'distinct' => 'השדה :attribute מכיל ערך כפול.',
    'doesnt_end_with' => 'השדה :attribute אסור שיסתיים באחד מהערכים הבאים: :values.',
    'doesnt_start_with' => 'השדה :attribute אסור שיתחיל באחד מהערכים הבאים: :values.',
    'email' => 'השדה :attribute חייב להיות כתובת אימייל תקפה.',
    'ends_with' => 'השדה :attribute חייב להסתיים באחד מהערכים הבאים: :values.',
    'enum' => 'הערך הנבחר של :attribute אינו תקף.',
    'exists' => 'הערך הנבחר של :attribute אינו תקף.',
    'extensions' => 'השדה :attribute חייב להכיל אחת מהסיומות הבאות: :values.',
    'file' => 'השדה :attribute חייב להיות קובץ.',
    'filled' => 'השדה :attribute חייב להכיל ערך.',
    'gt' => [
        'array' => 'השדה :attribute חייב להכיל יותר מ-:value פריטים.',
        'file' => 'השדה :attribute חייב להיות גדול מ-:value קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות גדול מ-:value.',
        'string' => 'השדה :attribute חייב להיות גדול מ-:value תווים.',
    ],
    'gte' => [
        'array' => 'השדה :attribute חייב להכיל :value פריטים או יותר.',
        'file' => 'השדה :attribute חייב להיות גדול או שווה ל-:value קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות גדול או שווה ל-:value.',
        'string' => 'השדה :attribute חייב להיות גדול או שווה ל-:value תווים.',
    ],
    'hex_color' => 'השדה :attribute חייב להיות צבע הקסדצימלי תקף.',
    'image' => 'השדה :attribute חייב להיות תמונה.',
    'in' => 'הערך הנבחר של :attribute אינו תקף.',
    'in_array' => 'השדה :attribute חייב להתקיים ב-:other.',
    'in_array_keys' => 'השדה :attribute חייב להכיל לפחות אחד מהמפתחות הבאים: :values.',
    'integer' => 'השדה :attribute חייב להיות מספר שלם.',
    'ip' => 'השדה :attribute חייב להיות כתובת IP תקפה.',
    'ipv4' => 'השדה :attribute חייב להיות כתובת IPv4 תקפה.',
    'ipv6' => 'השדה :attribute חייב להיות כתובת IPv6 תקפה.',
    'json' => 'השדה :attribute חייב להיות מחרוזת JSON תקפה.',
    'list' => 'השדה :attribute חייב להיות רשימה.',
    'lowercase' => 'השדה :attribute חייב להיות באותיות קטנות.',
    'lt' => [
        'array' => 'השדה :attribute חייב להכיל פחות מ-:value פריטים.',
        'file' => 'השדה :attribute חייב להיות קטן מ-:value קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות קטן מ-:value.',
        'string' => 'השדה :attribute חייב להיות קטן מ-:value תווים.',
    ],
    'lte' => [
        'array' => 'השדה :attribute אסור שיכיל יותר מ-:value פריטים.',
        'file' => 'השדה :attribute חייב להיות קטן או שווה ל-:value קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות קטן או שווה ל-:value.',
        'string' => 'השדה :attribute חייב להיות קטן או שווה ל-:value תווים.',
    ],
    'mac_address' => 'השדה :attribute חייב להיות כתובת MAC תקפה.',
    'max' => [
        'array' => 'השדה :attribute אסור שיכיל יותר מ-:max פריטים.',
        'file' => 'השדה :attribute אסור שיהיה גדול מ-:max קילובייט.',
        'numeric' => 'השדה :attribute אסור שיהיה גדול מ-:max.',
        'string' => 'השדה :attribute אסור שיהיה גדול מ-:max תווים.',
    ],
    'max_digits' => 'השדה :attribute אסור שיכיל יותר מ-:max ספרות.',
    'mimes' => 'השדה :attribute חייב להיות קובץ מסוג: :values.',
    'mimetypes' => 'השדה :attribute חייב להיות קובץ מסוג: :values.',
    'min' => [
        'array' => 'השדה :attribute חייב להכיל לפחות :min פריטים.',
        'file' => 'השדה :attribute חייב להיות לפחות :min קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות לפחות :min.',
        'string' => 'השדה :attribute חייב להיות לפחות :min תווים.',
    ],
    'min_digits' => 'השדה :attribute חייב להכיל לפחות :min ספרות.',
    'missing' => 'השדה :attribute חייב להיות חסר.',
    'missing_if' => 'השדה :attribute חייב להיות חסר כאשר :other הוא :value.',
    'missing_unless' => 'השדה :attribute חייב להיות חסר אלא אם כן :other הוא :value.',
    'missing_with' => 'השדה :attribute חייב להיות חסר כאשר :values קיים.',
    'missing_with_all' => 'השדה :attribute חייב להיות חסר כאשר :values קיימים.',
    'multiple_of' => 'השדה :attribute חייב להיות כפולה של :value.',
    'not_in' => 'הערך הנבחר של :attribute אינו תקף.',
    'not_regex' => 'פורמט השדה :attribute אינו תקף.',
    'numeric' => 'השדה :attribute חייב להיות מספר.',
    'password' => [
        'letters' => 'השדה :attribute חייב להכיל לפחות אות אחת.',
        'mixed' => 'השדה :attribute חייב להכיל לפחות אות גדולה אחת ואות קטנה אחת.',
        'numbers' => 'השדה :attribute חייב להכיל לפחות מספר אחד.',
        'symbols' => 'השדה :attribute חייב להכיל לפחות סימן אחד.',
        'uncompromised' => 'ה-:attribute הנתון הופיע בדליפת נתונים. אנא בחר :attribute אחר.',
    ],
    'present' => 'השדה :attribute חייב להיות נוכח.',
    'present_if' => 'השדה :attribute חייב להיות נוכח כאשר :other הוא :value.',
    'present_unless' => 'השדה :attribute חייב להיות נוכח אלא אם כן :other הוא :value.',
    'present_with' => 'השדה :attribute חייב להיות נוכח כאשר :values נוכח.',
    'present_with_all' => 'השדה :attribute חייב להיות נוכח כאשר :values נוכחים.',
    'prohibited' => 'השדה :attribute אסור.',
    'prohibited_if' => 'השדה :attribute אסור כאשר :other הוא :value.',
    'prohibited_if_accepted' => 'השדה :attribute אסור כאשר :other מאושר.',
    'prohibited_if_declined' => 'השדה :attribute אסור כאשר :other דחוי.',
    'prohibited_unless' => 'השדה :attribute אסור אלא אם כן :other הוא ב-:values.',
    'prohibits' => 'השדה :attribute אוסר על :other להיות נוכח.',
    'regex' => 'פורמט השדה :attribute אינו תקף.',
    'required' => 'השדה :attribute נדרש.',
    'required_array_keys' => 'השדה :attribute חייב להכיל ערכים עבור: :values.',
    'required_if' => 'השדה :attribute נדרש כאשר :other הוא :value.',
    'required_if_accepted' => 'השדה :attribute נדרש כאשר :other מאושר.',
    'required_if_declined' => 'השדה :attribute נדרש כאשר :other דחוי.',
    'required_unless' => 'השדה :attribute נדרש אלא אם כן :other הוא ב-:values.',
    'required_with' => 'השדה :attribute נדרש כאשר :values נוכח.',
    'required_with_all' => 'השדה :attribute נדרש כאשר :values נוכחים.',
    'required_without' => 'השדה :attribute נדרש כאשר :values אינו נוכח.',
    'required_without_all' => 'השדה :attribute נדרש כאשר אף אחד מ-:values אינו נוכח.',
    'same' => 'השדה :attribute חייב להתאים ל-:other.',
    'size' => [
        'array' => 'השדה :attribute חייב להכיל :size פריטים.',
        'file' => 'השדה :attribute חייב להיות :size קילובייט.',
        'numeric' => 'השדה :attribute חייב להיות :size.',
        'string' => 'השדה :attribute חייב להיות :size תווים.',
    ],
    'starts_with' => 'השדה :attribute חייב להתחיל באחד מהערכים הבאים: :values.',
    'string' => 'השדה :attribute חייב להיות מחרוזת.',
    'timezone' => 'השדה :attribute חייב להיות אזור זמן תקף.',
    'unique' => 'ה-:attribute כבר תפוס.',
    'uploaded' => 'ה-:attribute נכשל בהעלאה.',
    'uppercase' => 'השדה :attribute חייב להיות באותיות גדולות.',
    'url' => 'השדה :attribute חייב להיות כתובת URL תקפה.',
    'ulid' => 'השדה :attribute חייב להיות ULID תקף.',
    'uuid' => 'השדה :attribute חייב להיות UUID תקף.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
