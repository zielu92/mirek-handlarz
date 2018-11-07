
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Page level plugin JavaScript-->

<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin.min.js')}}"></script>
{{--<!-- Custom scripts for this page-->--}}
{{--<script src="{{asset('js/sb-admin-datatables.min.js')}}"></script>--}}

<script>
    $(function()
    {
        $( "#searchForm" ).autocomplete({
            source: "/admin/autocomplete",
            messages: {
                noResults: '',
                results: function() {

                }
            },
            minLength: 2,
            select: function(event, ui) {
                window.location = ui.item.link;
            }
        });
    });

</script>

@yield('scripts')


</div>
</body>

</html>