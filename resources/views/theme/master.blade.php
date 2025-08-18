@include('theme.partials.head')


@include('theme.partials.nav')
<!--================ Hero sm Banner start =================-->

<!--================ Hero sm Banner end =================-->


<!--================ Start Blog Post Area =================-->
@yield('content')
<!--================ End Blog Post Area =================-->

<!--================ Start Footer Area =================-->
@include('theme.partials.footer')
<!--================ End Footer Area =================-->

@include('theme.partials.script')
</body>

</html>
