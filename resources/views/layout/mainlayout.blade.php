<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>

  <body>

 @include('layout.partials.nav')

        @include('layout.partials.header')
        @include('layout.partials.footer-scripts')
 @yield('content')
    </div>
<script>
$(document).ready(function($) {

});

function dateFormate(date){
    let objDate = new Date(date),
    month = objDate.getMonth(),
    day = objDate.getDate(),
    year = objDate.getFullYear()

    return day + '-' + month + '-' + year;
}
</script>
  </body>
</html>
