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

    'accepted'             => 'Μη αποδεκτό πεδίο.',
    'active_url'           => 'Μη έγκυρη διεύθυνση URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'Το πεδίο πρέπει να είναι μεταξύ :min και :max.',
        'file'    => 'Το πεδίο πρέπει να είναι μεταξύ :min και :max kilobytes.',
        'string'  => 'Το πεδίο πρέπει να είναι μεταξύ :min και :max χαρακτήρες   .',
        'array'   => 'Το πλήθος των στοιχείων του πεδίου θα πρέπει να είναι μεταξύ :min και :max.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'Δεν συμφωνεί το πεδίο με την επιβεβαίωσή του.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'email'                => 'Μη έγκυρη διεύθυνση email.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'Το αρχείο δεν μπορεί να είναι μεγαλύτερο από :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Επιτρεπόμενες επεκτάσεις αρχείων: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'Το πεδίο πρέπει να αποτελείται από τουλάχιστον :min χαρακτήρες.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'Το πεδίο είναι υποχρεωτικό.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'Η τιμή για το πεδίο υπάρχει ήδη.',
    'url'                  => 'The :attribute format is invalid.',

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
        'password' => [
            'confirmed' => 'Οι Κωδικοί Πρόσβασης πρέπει να ταιριάζουν.',
        ],
        'grader_email' => [
            'confirmed' => 'Τα email πρέπει να ταιριάζουν.',
        ],
        'english_level' => [
            'required_if' => 'Εφόσον έχετε επιλέξει τη γλώσσα, θα πρέπει να επιλέξετε και το επίπεδο.'
        ],
        'french_level' => [
            'required_if' => 'Εφόσον έχετε επιλέξει τη γλώσσα, θα πρέπει να επιλέξετε και το επίπεδο.'
        ],
        'german_level' => [
            'required_if' => 'Εφόσον έχετε επιλέξει τη γλώσσα, θα πρέπει να επιλέξετε και το επίπεδο.'
        ],
        'italian_level' => [
            'required_if' => 'Εφόσον έχετε επιλέξει τη γλώσσα, θα πρέπει να επιλέξετε και το επίπεδο.'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
