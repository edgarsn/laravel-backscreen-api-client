# Endpoint Reference

All endpoints live in `src/Endpoints/{Group}/` and follow the same structure:
- Extend `AbstractEndpoint`, implement `EndpointContract`
- Constructor takes required params; optional params via fluent setters
- `prepareHttpRequest(PendingRequest $http)` builds the request body/query

## Endpoint Groups

### Media — `src/Endpoints/Media/`

| Class | HTTP | URL | Auth |
|-------|------|-----|------|
| `Create` | POST | `/Media/Create` | BASIC, BEARER |
| `Update` | PUT | `/Media/Update` | BASIC, BEARER |
| `Delete` | DELETE | `/Media/Delete` | BASIC, BEARER |
| `MediaList` | GET | `/Media/List` | BASIC, BEARER, API_KEY |
| `Publish` | POST | `/Media/Publish` | BASIC, BEARER |
| `Transcode` | POST | `/Media/Transcode` | BASIC, BEARER |
| `CancelTranscode` | POST | `/Media/CancelTranscode` | BASIC, BEARER |
| `CloneMedia` | POST | `/Media/Clone` | BASIC, BEARER |
| `Trim` | POST | `/Media/Trim` | BASIC, BEARER |
| `Reset` | POST | `/Media/Reset` | BASIC, BEARER |
| `Validate` | POST | `/Media/Validate` | BASIC, BEARER |
| `GenerateImage` | POST | `/Media/GenerateImage` | BASIC, BEARER |
| `RegeneratePackages` | POST | `/Media/RegeneratePackages` | BASIC, BEARER |
| `RemoveWarning` | POST | `/Media/RemoveWarning` | BASIC, BEARER |
| `UpdateSubtitlesFromSource` | POST | `/Media/UpdateSubtitlesFromSource` | BASIC, BEARER |
| `UploadToExternal` | POST | `/Media/UploadToExternal` | BASIC, BEARER |

**Media/Create sub-objects** (all in `src/Endpoints/Media/Create/`):
`Availability`, `Embed`, `Files`, `Images`, `Player`, `PlayerCustomTitle`, `Presentation`, `PresentationConfig`, `Security`, `Tags`, `TranscodeInfo`

**Media/Update sub-objects** (in `src/Endpoints/Media/Update/`):
`ByAssetId`, `ByMediaId`, `ByContract`, `Embed`, `Images`, `MaterialChange`, `Tags`, `UpdateManifest`

**Media Manifest** (in `src/Endpoints/Media/Manifest/`):
`Create`, `Update`, `Delete`, `ManifestList` — manage per-media manifests

### Live — `src/Endpoints/Live/`

| Class | HTTP | URL | Auth |
|-------|------|-----|------|
| `Create` | POST | `/Live/Create` | BASIC, BEARER |
| `Update` | PUT | `/Live/Update` | BASIC, BEARER |
| `Delete` | DELETE | `/Live/Delete` | BASIC, BEARER |
| `LiveList` | GET | `/Live/List` | BASIC, BEARER |
| `On` | POST | `/Live/On` | BASIC, BEARER |
| `Off` | POST | `/Live/Off` | BASIC, BEARER |
| `Record` | POST | `/Live/Record` | BASIC, BEARER |

**Live/Create sub-objects** (in `src/Endpoints/Live/Create/`):
`Availability`, `Embed`, `Input`, `Publish`, `Recording`, `Security`
`Input` sub-objects: `Input`, `Packager`, `AudioLanguage`
`Recording` sub-objects: `Recording`, `EPG`, `Nimbus`

### Folder — `src/Endpoints/Folder/`

| Class | HTTP | URL | Auth |
|-------|------|-----|------|
| `Create` | POST | `/Folder/Create` | BASIC, BEARER |
| `Update` | PUT | `/Folder/Update` | BASIC, BEARER |
| `UpdateMulti` | PUT | `/Folder/UpdateMulti` | BASIC, BEARER |
| `Delete` | DELETE | `/Folder/Delete` | BASIC, BEARER |
| `Get` | GET | `/Folder/Get` | BASIC, BEARER |
| `FolderList` | GET | `/Folder/List` | BASIC, BEARER |
| `GetInfo` | GET | `/Folder/GetInfo` | BASIC, BEARER |
| `CreateFtpFolder` | POST | `/Folder/CreateFtp` | BASIC, BEARER |
| `GetFtpFolderList` | GET | `/Folder/GetFtpList` | BASIC, BEARER |

**Folder/Create sub-objects** (in `src/Endpoints/Folder/Create/`):
`Availability`, `Embed`, `ExternalUploads`, `Ingest`, `Language`, `MultiAudio`, `MultiAudioConditions`, `MultiAudioGroup`, `MultiAudioInputConfig`, `MultiAudioTrack`, `Security`, `ShowRelated`, `Transcoding`

### Token — `src/Endpoints/Token/`

| Class | HTTP | URL | Auth |
|-------|------|-----|------|
| `Generate` | POST | `/Token/Generate` | BASIC, BEARER, API_KEY |

Enums: `ItemTypeEnum`, `SubitemTypeEnum` (in `src/Endpoints/Token/Generate/`)

### User — `src/Endpoints/User/`

| Class | HTTP | URL | Auth |
|-------|------|-----|------|
| `Login` | POST | `/User/Login` | NULL only |
| `Logout` | POST | `/User/Logout` | BEARER only |
| `Get` | GET | `/User/Get` | BEARER only |

`Login` returns a bearer token — use `BearerAuthMethod($response->json('token'))` after.

## EndpointSupport Shared Classes

`src/EndpointSupport/`:
- `Callback` — reusable callback config (URL, method)
- `Images` — legacy image helper (thumbnail, placeholder); in new endpoints prefer `Media/Create/Images`

`src/EndpointSupport/Enums/`:
- `CallbackHttpMethodEnum` — GET, POST
- `OrderDirectionEnum` — ASC, DESC

## Implementing `prepareHttpRequest`

Pattern for POST endpoints:
```php
public function prepareHttpRequest(PendingRequest $http): void
{
    $data = ['required_field' => $this->required_field];

    if ($this->optional !== null) {
        $data['optional'] = $this->optional;
    }

    if ($this->sub_object !== null) {
        $compiled = $this->sub_object->compileAsArray();
        if (! empty($compiled)) {
            $data['sub_object'] = $compiled;
        }
    }

    $http->withData($data);
}
```

Pattern for GET endpoints:
```php
public function prepareHttpRequest(PendingRequest $http): void
{
    $query = ['id' => $this->id];
    if ($this->filter !== null) {
        $query['filter'] = $this->filter;
    }
    $http->withQuery($query);
}
```
