# Amr Component

# Install
``````````````
first clone new project

second composer require mirosadoma/amr_components

php artisan vendor:publish --tag=amr_components --ansi
``````````````
# Used
```````````````
for create new component :

php artisan component:create {component_name}

- And Follow These Steps In The Terminal

................................................................

- What Is The Count Of Your Inputs:
=> Write The Count Of The Inputs
like : 3

- Please Write The Name Of Input 1 :-
=> Write The Name Only Like In The Column In Database
like : title

- Please Write The Type Of Input (title) In Table [ string, integer, tinyInteger, bigInteger, float, double, decimal, text, longText, date, dateTime, time, timestamp ] :-
=> Write The Type From Up Only , If Not In Up You Will Have A Message "Type Not Found Please Choose From Up"
like : string

- Please Write If The Input (title) Is Translation Or Not [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if The Input have tow languages You Can Choose "y" If Not You Can Choose "n"
like : y

- If This Input (title) Is File Upload ? [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if The Input Is File Type You Can Choose "y" If Not You Can Choose "n"
like : n

- Do You Want This Input (title) In Search [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if You Want The Input In Index.php File In Search Wedgit You Can Choose "y" If Not You Can Choose "n"
like : Y

if answer is "y"
- If This Input (title) Is Select [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if You Want The Input In Search Wedgit Is Select You Can Choose "y" If Not You Can Choose "n"
like : n

-  Please Write The Name Of Input 2 :-
=> Write The Name Only Like In The Column In Database
like : price

- Please Write The Type Of Input (price) In Table [ string, integer, tinyInteger, bigInteger, float, double, decimal, text, longText, date, dateTime, time, timestamp ] :-
=> Write The Type From Up Only , If Not In Up You Will Have A Message "Type Not Found Please Choose From Up"
like : integer

- Do You Want This Input (price) In Search [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if You Want The Input In Index.php File In Search Wedgit You Can Choose "y" If Not You Can Choose "n"
like : n

- Please Write The Name Of Input 3 :-:
=> Write The Name Only Like In The Column In Database
like : image

- Please Write The Type Of Input (image) In Table [ string, integer, tinyInteger, bigInteger, float, double, decimal, text, longText, date, dateTime, time, timestamp ] :-
=> Write The Type From Up Only , If Not In Up You Will Have A Message "Type Not Found Please Choose From Up"
like : string

- Please Write If The Input (image) Is Translation Or Not [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if The Input have tow languages You Can Choose "y" If Not You Can Choose "n"
like : n

- If This Input (title) Is File Upload ? [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if The Input Is File Type You Can Choose "y" If Not You Can Choose "n"
like : y

-  If This File Upload (image) Is :-  [ image , file ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if The Input Is File Type Is Image You Can Choose "image" Else If File You Can Choose "file"
like : image

- If This File Upload (image) Is Multiple :-  [ y , n ] :-
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if The File Type Is Multiple You Can Choose "y" If Not You Can Choose "n"
like : y


====== If The Component Name Is Found Befor You Can Of : =======

- This Component Name Is Found Do Yo Want Replace This ? [Y | N]:
=> Write y Or n From Up Only , If Not In Up You Will Have A Message "Answer Not Found Please Choose From Up"
if You Want Replace It You Can Choose "y" If Not You Can Choose "n"
if like "n"

The End Message Is : Component Create Stop

else like "y"

The End Message Is : {component_name} Component Created

````````````````
# ENV
```````````````
GOOGLE_API_KEY=GOOHELASASDASDASDASSDS
```````````````