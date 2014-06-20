RequestId
---------
Just a proof of concept

Request as
`RequestId::generateFromOther(
    new \RequestId("1m3ne2",
        new \RequestId("4234ds",
            new \RequestId("09942a")
        )
    )
 );`

It generates
`324543e28e683f563a7b1c18a4eb52bf31cab6d3;1m3ne2;4234ds;09942a`
