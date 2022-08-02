# Amr Component

# Install
``````````````
first clone amr project
https://github.com/amr_mohamed/amr_componnent.git
composer dump-autoload
composer require amr/component:dev-master
>>config>>app.php
  providers = [
    Amr\AmrComponents\AmrServiceProvider::class,
  ];
php artisan vendor:publish --tag=public_all --force
``````````````
# Used
```````````````
for create new component
php artisan component:create {component_name}
for create view
php artisan component:view {component_name} --type=index --type=edit --type=create
for create migrate
php artisan component:migrate {component_name} --M=file_name
````````````````
# ENV
```````````````
GOOGLE_API_KEY=GOOHELASASDASDASDASSDS
```````````````
# Helpers
```````````````
$number = 50123456755552
sanitize_mobile($number) >> 966501234567
-------
$info = 'place_id' || 'address_name';
GetPlaceInformation($lat,$lng,$info)
-------
create input
from_input($name, $label, $type = 'text', $value = '', $lang = null, $autocomplete = null)
-----
create text area
from_input_textarea($name, $label, $value = '', $lang = '')
-----
create from image
from_image($name, $value = '', $label,$multiple = false)
-----
Upload image
file_upload($file, $path = '', $wh = [], $base64 = false, $watermark = false)
```````````````


