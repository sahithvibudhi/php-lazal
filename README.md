# Lazal PHP Client

- Making a connection to Lazal Server

```
$client = new Lazal\Client(['host'=>'127.0.0.1', 'port' => 5555]);
```

- Writing data

```
$client->set('key1', 'value');
```

- Fetching data

```
$value = $client->get('key1');
```

- Deleting data

```
$client->delete('key1');
```