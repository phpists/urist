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


    'accepted' => 'Поле :attribute повинно бути прийнято.',
    'accepted_if' => 'Поле :attribute повинно бути прийнято, коли :other є :value.',
    'active_url' => 'Поле :attribute повинно бути правильним URL.',
    'after' => 'Поле :attribute повинно бути датою після :date.',
    'after_or_equal' => 'Поле :attribute повинно бути датою після або рівною :date.',
    'alpha' => 'Поле :attribute повинно містити лише літери.',
    'alpha_dash' => 'Поле :attribute може містити лише літери, цифри, дефіси та підкреслення.',
    'alpha_num' => 'Поле :attribute може містити лише літери та цифри.',
    'array' => 'Поле :attribute повинно бути масивом.',
    'ascii' => 'Поле :attribute може містити лише однобайтові буквено-цифрові символи та символи.',
    'before' => 'Поле :attribute повинно бути датою до :date.',
    'before_or_equal' => 'Поле :attribute повинно бути датою до або рівною :date.',
    'between' => [
        'array' => 'Поле :attribute повинно містити від :min до :max елементів.',
        'file' => 'Поле :attribute повинно бути від :min до :max кілобайт.',
        'numeric' => 'Поле :attribute повинно бути від :min до :max.',
        'string' => 'Поле :attribute повинно бути від :min до :max символів.',
    ],
    'boolean' => 'Поле :attribute повинно бути true або false.',
    'can' => 'Поле :attribute містить невірне значення.',
    'confirmed' => 'Підтвердження поля :attribute не збігається.',
    'current_password' => 'Неправильний пароль.',
    'date' => 'Поле :attribute повинно бути коректною датою.',
    'date_equals' => 'Поле :attribute повинно бути датою, рівною :date.',
    'date_format' => 'Поле :attribute повинно відповідати формату :format.',
    'decimal' => 'Поле :attribute повинно мати :decimal знаків після коми.',
    'declined' => 'Поле :attribute повинно бути відхилено.',
    'declined_if' => 'Поле :attribute повинно бути відхилено, коли :other є :value.',
    'different' => 'Поля :attribute та :other повинні бути різними.',
    'digits' => 'Поле :attribute повинно мати :digits цифр.',
    'digits_between' => 'Поле :attribute повинно бути від :min до :max цифр.',
    'dimensions' => 'Поле :attribute має невірні розміри зображення.',
    'distinct' => 'Поле :attribute має дубльоване значення.',
    'doesnt_end_with' => 'Поле :attribute не повинно закінчуватися одним з наступних значень: :values.',
    'doesnt_start_with' => 'Поле :attribute не повинно починатися одним з наступних значень: :values.',
    'email' => 'Поле :attribute повинно бути коректною електронною адресою.',
    'ends_with' => 'Поле :attribute повинно закінчуватися одним з наступних значень: :values.',
    'enum' => 'Вибране значення для :attribute є невірним.',
    'exists' => 'Обране значення для :attribute є невірним.',
    'extensions' => 'Поле :attribute повинно мати одне з наступних розширень: :values.',
    'file' => 'Поле :attribute повинно бути файлом.',
    'filled' => 'Поле :attribute повинно містити значення.',
    'gt' => [
        'array' => 'Поле :attribute повинно містити більше ніж :value елементів.',
        'file' => 'Поле :attribute повинно бути більше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більше ніж :value.',
        'string' => 'Поле :attribute повинно бути більше ніж :value символів.',
    ],
    'gte' => [
        'array' => 'Поле :attribute повинно містити :value елементів або більше.',
        'file' => 'Поле :attribute повинно бути більше або рівне :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більше або рівне :value.',
        'string' => 'Поле :attribute повинно бути більше або рівне :value символів.',
    ],
    'hex_color' => 'Поле :attribute повинно бути коректним шестнадцятковим кольором.',
    'image' => 'Поле :attribute повинно бути зображенням.',
    'in' => 'Обране значення для :attribute є невірним.',
    'in_array' => 'Поле :attribute повинно існувати в :other.',
    'integer' => 'Поле :attribute повинно бути цілим числом.',
    'ip' => 'Поле :attribute повинно бути коректною IP-адресою.',
    'ipv4' => 'Поле :attribute повинно бути коректною IPv4-адресою.',
    'ipv6' => 'Поле :attribute повинно бути коректною IPv6-адресою.',
    'json' => 'Поле :attribute повинно бути коректним JSON-рядком.',
    'lowercase' => 'Поле :attribute повинно бути в нижньому регістрі.',
    'lt' => [
        'array' => 'Поле :attribute повинно містити менше ніж :value елементів.',
        'file' => 'Поле :attribute повинно бути менше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути менше ніж :value.',
        'string' => 'Поле :attribute повинно бути менше ніж :value символів.',
    ],
    'lte' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :value елементів.',
        'file' => 'Поле :attribute повинно бути менше або рівне :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути менше або рівне :value.',
        'string' => 'Поле :attribute повинно бути менше або рівне :value символів.',
    ],
    'mac_address' => 'Поле :attribute повинно бути коректною MAC-адресою.',
    'max' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :max елементів.',
        'file' => 'Поле :attribute не повинно бути більше ніж :max кілобайт.',
        'numeric' => 'Поле :attribute не повинно бути більше ніж :max.',
        'string' => 'Поле :attribute не повинно бути більше ніж :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно містити більше ніж :max цифр.',
    'mimes' => 'Поле :attribute повинно бути файлом типу: :values.',
    'mimetypes' => 'Поле :attribute повинно бути файлом типу: :values.',
    'min' => [
        'array' => 'Поле :attribute повинно містити принаймні :min елементів.',
        'file' => 'Поле :attribute повинно бути принаймні :min кілобайт.',
        'numeric' => 'Поле :attribute повинно бути принаймні :min.',
        'string' => 'Поле :attribute повинно бути принаймні :min символів.',
    ],
    'min_digits' => 'Поле :attribute повинно містити принаймні :min цифр.',
    'missing' => 'Поле :attribute повинно бути відсутнім.',
    'missing_if' => 'Поле :attribute повинно бути відсутнім, коли :other є :value.',
    'missing_unless' => 'Поле :attribute повинно бути відсутнім, якщо :other не є :value.',
    'missing_with' => 'Поле :attribute повинно бути відсутнім, коли присутній :values.',
    'missing_with_all' => 'Поле :attribute повинно бути відсутнім, коли присутній хоча б один з :values.',
    'multiple_of' => 'Поле :attribute повинно бути кратним :value.',
    'not_in' => 'Обране значення для :attribute є невірним.',
    'not_regex' => 'Формат поля :attribute є невірним. 1231',
    'numeric' => 'Поле :attribute повинно бути числом.',
    'password' => [
        'letters' => 'Поле :attribute повинно містити принаймні одну літеру.',
        'mixed' => 'Поле :attribute повинно містити принаймні одну велику і одну малу літеру.',
        'numbers' => 'Поле :attribute повинно містити принаймні одну цифру.',
        'symbols' => 'Поле :attribute повинно містити принаймні один символ.',
        'uncompromised' => 'Задане значення для :attribute зявилося у витоку даних. Будь ласка, виберіть інше значення для :attribute.',
    ],
    'present' => 'Поле :attribute повинно бути присутнім.',
    'present_if' => 'Поле :attribute повинно бути присутнім, коли :other є :value.',
    'present_unless' => 'Поле :attribute повинно бути присутнім, якщо :other не є :value.',
    'present_with' => 'Поле :attribute повинно бути присутнім, коли є присутніми :values.',
    'present_with_all' => 'Поле :attribute повинно бути присутнім, коли є присутніми всі :values.',
    'prohibited' => 'Поле :attribute заборонено.',
    'prohibited_if' => 'Поле :attribute заборонено, коли :other є :value.',
    'prohibited_unless' => 'Поле :attribute заборонено, якщо :other не є в :values.',
    'prohibits' => 'Поле :attribute забороняє наявність :other.',
    'regex' => 'Формат поля :attribute недійсний.',
    'regex_letter_digits' => 'Поле має включати літери та цифри',
    'required' => 'Поле :attribute обов’язкове для заповнення.',
    'required_array_keys' => 'Поле :attribute повинно містити записи для: :values.',
    'required_if' => 'Поле :attribute обов’язкове, коли :other є :value.',
    'required_if_accepted' => 'Поле :attribute обов’язкове, коли :other прийнято.',
    'required_unless' => 'Поле :attribute обов’язкове, якщо :other не є в :values.',
    'required_with' => 'Поле :attribute обов’язкове, коли є присутніми :values.',
    'required_with_all' => 'Поле :attribute обов’язкове, коли є присутніми всі :values.',
    'required_without' => 'Поле :attribute обов’язкове, коли відсутні :values.',
    'required_without_all' => 'Поле :attribute обов’язкове, коли відсутні всі :values.',
    'same' => 'Поле :attribute повинно співпадати з :other.',
    'size' => [
        'array' => 'Поле :attribute повинно містити :size елементи.',
        'file' => 'Поле :attribute повинно бути розміром :size кілобайт.',
        'numeric' => 'Поле :attribute повинно бути :size.',
        'string' => 'Поле :attribute повинно бути довжиною :size символи.',
    ],
    'starts_with' => 'Поле :attribute повинно починатися з одного з наступних: :values.',
    'string' => 'Поле :attribute повинно бути рядком.',
    'timezone' => 'Поле :attribute повинно бути дійсним часовим поясом.',
    'unique' => 'Поле :attribute вже існує.',
    'uploaded' => 'Поле :attribute не вдалося завантажити.',
    'uppercase' => 'Поле :attribute повинно бути у верхньому регістрі.',
    'url' => 'Поле :attribute повинно бути дійсною URL-адресою.',
    'ulid' => 'Поле :attribute повинно бути дійсним ULID.',
    'uuid' => 'Поле :attribute повинно бути дійсним UUID.',

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
        'name' => [
            'required' => 'Введіть, будь ласка, імя',
        ],
        'phone' => [
            'required' => 'Введіть, будь ласка, номер телефону',
            'size' => 'Некоректний формат номеру телефона',
            'unique' => 'Номер вже використовується'
        ],
        'password' => [
            'required' => 'Введіть, будь ласка, пароль',
            'confirmed' => 'Підтвердіть, будь ласка, пароль',
            'new_letter_digits' => 'Пароль повинен містити букви та цифри',
            'min' => 'Пароль повинен містити принаймні :min символів',
            'unique' => 'Користувач вже використовує цей номер телефону'
        ],
        'password_confirmation' => [
            'required' => 'Підтвердіть, будь ласка, пароль',
        ],
        'policy' => [
            'required' => 'Оберіть, будь ласка, політику конфіденційності',
            'accepted' => 'Потрібно прийняти політику конфіденційності',
        ],
        'g-recaptcha-response' => [
            'required' => 'Заповніть, будь ласка, захист від роботів',
            'captcha' => 'Захист від роботів не пройшла перевірку',
        ],
        'code' => [
            'size' => 'Поле код має містити :size цифри',
            'required' => 'Поле код обовязкове'
        ]

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
