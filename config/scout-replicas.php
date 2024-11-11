<?php

return [
    'criminal-articles' => [
        'criminal_articles_date_asc' => [
            'ranking' => ['asc(date_timestamp)'],
//            'customRanking' => ['asc(date_timestamp)'],
//            'relevancyStrictness' => 0 // only for virtual
        ],
        'criminal_articles_date_desc' => [
            'ranking' => ['desc(date_timestamp)'],
//            'customRanking' => ['desc(date_timestamp)'],
//            'relevancyStrictness' => 0 // only for virtual
        ],
        'criminal_articles_hierarchy' => [
            'ranking' => ['desc(tag_priority)'],
//            'customRanking' => ['desc(date_timestamp)'],
//            'relevancyStrictness' => 0 // only for virtual
        ]
    ]
];
