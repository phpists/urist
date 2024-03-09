<?php

return [
    'criminal-articles' => [
        'criminal_articles_date_asc' => [
            'customRanking' => ['asc(date_timestamp)'],
            'relevancyStrictness' => 0
        ],
        'criminal_articles_date_desc' => [
            'customRanking' => ['desc(date_timestamp)'],
            'relevancyStrictness' => 0
        ]
    ]
];
