# V2 structure

Ideally we will write a database ruleset that we can pull from as defined in the comments related to the tick function. this is a data example.
but for this to work we need to not be using the name which is bad practice but instead introduce a type field to reference for the rule or how will we be able to properly add original names

    [ 
        name: 'Get Older',
        rule: {
            dueInRule: [
            {0=>1},
            ],
            priorityRule: [
            {0=>1}
            ],
            priorityDirection: -,
            priorityMin: 0,
            priorityMax: 100,
            
        },
        name: 'Breath',
        rule: {
            dueInRule: [
            {0=>0},
            ],
            priorityRule: [
            {0=>0}
            ],
            priorityDirection: =,
            priorityMin: 1000,
            priorityMax: 1000,
        },
        name: 'Complete Assessment',
        rule: {
            dueInRule: [
            {0=>1},
            ],
            priorityRule: [
            {11=>1},
            {6=>2},
            {0=>5}
            ],
            priorityDirection: +,
            priorityMin: 0,
            priorityMax: 100,
            
        },
    ]
