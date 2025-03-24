{{-- <script src="{{ asset('admin') }}/js/jquery-3.3.1.min.js"></script> --}}
<script src="{{ asset('admin') }}/js/popper.min.js"></script>
<script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('admin') }}/js/main.js"></script>
<script src="{{ asset('admin') }}/js/plugins/pace.min.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/plugins/chart.js"></script>

    <!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('admin/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>

<script src="{{ asset('admin') }}/plugins/simplebar/js/simplebar.js"></script>
<script src="{{ asset('admin') }}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
<script>
    $('.multiple-select').select2({
        // theme: 'bootstrap4',
        // width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>


{{-- custom --}}
<script>
$(function() {
    jQuery("[name=select_all]").click(function(source) {
        checkboxes = jQuery("[name=delete_select]");
        for (var i in checkboxes) {
            checkboxes[i].checked = source.target.checked;
        }
    });
})
</script>
<script type="text/javascript">
    $(function() {
        $('#btn_delete_all').click(function() {
            var selected = [];
            $("input:checkbox[name=delete_select]:checked").each(function() {
                selected.push($(this).val());
            });
            if (selected.length > 0) {
                $('#bulkdeleteall').modal('show');
                $('input[id="delete_all"]').val(selected);
            }
            else{
                swal({
                    title: "Oops!",
                    text: "Please select at least one record",
                    icon: "error",
                    button: "OK",
                });
            }
        });
    });
</script>
<script>
    $(".img").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $(".img2").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview2").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<script src="{{ asset('admin') }}/js/custom.js"></script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript">
		CKEDITOR.config.language ="{{ app()->getLocale() }}";
	</script>
{{-- <script>
    // print
if (document.getElementById("prt-content")) {
    const btnPrtContent = document.getElementById("btn-prt-content");
    btnPrtContent.addEventListener("click", printDiv);

    function printDiv() {
        const prtContent = document.getElementById("prt-content");
        const langAttribute = document.documentElement.getAttribute("lang")|| "{{ app()->getLocale() }}";
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(prtContent.cloneNode(true));
        if (langAttribute) {
            newWin.document.documentElement.setAttribute("lang", langAttribute);
        }
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
}
</script> --}}
<script>
    // Print Functionality
    if (document.getElementById("prt-content")) {
        const btnPrtContent = document.getElementById("btn-prt-content");
        btnPrtContent.addEventListener("click", printDiv);

        function printDiv() {
            const prtContent = document.getElementById("prt-content");
            const langAttribute = document.documentElement.getAttribute("lang") || "ar";

            const newWin = window.open("", "_blank");
            newWin.document.write(`<!DOCTYPE html>
            <html lang="${langAttribute}">
            <head>${document.head.innerHTML}</head>
            <body>${prtContent.outerHTML}</body>
            </html>`);

            setTimeout(() => {
                newWin.document.close();
                newWin.print();
                newWin.close();
            }, 600);
        }
    }
</script>
