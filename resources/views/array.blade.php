<?php
$data = [
    "input" => [
        "type",
        "name",
        "placeholder",
        "value",
        "class",
        "id",
        "disabled" => false,
        "readonly" => false,
        "textarea" => null,
        "rows" => null,
        "label" => [
            "text" => null,
            "class",
        ],
        "parent_class",
        "parent_id"
    ],
    "select" => [
        "multiple" => false,
        "disabled" => false,
        "name",
        "placeholder",
        "class",
        "id",
        "label" => [
            "text" => null,
            "class",
        ],
        "parent_class",
        "parent_id",
        "options" => []
    ],
    "checkbox" => [
        "type",
        "name",
        "value",
        "class",
        "id",
        "role" => false,
        "checked" => false,
        "disabled" => false,
        "label" => [
            "text" => null,
            "class",
        ],
        "parent_class",
        "parent_id",
        "options" => []
    ],
"file" => [
    "file_type" => ['png', 'pdf', 'doc'],
    "file_viewer" => [
        "parent" => ['id', 'class' ],
        'id' , 'class',
        'show' => ['top', 'left', 'below', 'right', 'none']
    ]
]
];


?>


