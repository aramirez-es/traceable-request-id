RequestId
---------
Just a proof of concept

Request as
```php
RequestId::generateFromOther(
    new \RequestId("1m3ne2",
        new \RequestId("4234ds",
            new \RequestId("09942a")
        )
    )
);
```

It generates
```php
'324543e28e683f563a7b1c18a4eb52bf31cab6d3;1m3ne2;4234ds;09942a'
```

Missing things:
* _generateFromString_ that parse a given string and return a RequestId.
* check how _isEqualTo_ method works with parents.
* Maybe extract all _generate_ methods to a _RequestIdBuilder_ and keep RequestId as simple as possible.
