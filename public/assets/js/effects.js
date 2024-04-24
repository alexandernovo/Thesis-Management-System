$(".logout").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
        type: "warning",
        icon: "warning",
        title: "Are You Sure?",
        text: "You will be logout",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Logout",
        customClass: {
            actions: "my-actions",
            cancelButton: "order-1 right-gap",
            confirmButton: "order-2",
            container: "my-swal",
        },
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});


const $input = $('#image-upload');
const $preview = $('#preview-image');
const $container = $('#image-container');

$input.on('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            $preview.attr('src', reader.result);
        });
        reader.readAsDataURL(file);
    }
    else {
        $preview.attr('src', '#');
    }
});

$container.on('dragover', function (e) {
    e.preventDefault();
    $container.addClass('dragover');
});

$container.on('dragleave', function (e) {
    e.preventDefault();
    $container.removeClass('dragover');
});

$container.on('drop', function (e) {
    e.preventDefault();
    $container.removeClass('dragover');
    const file = e.originalEvent.dataTransfer.files[0];
    if (file.type.match(/^image\//)) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            $preview.attr('src', reader.result);
        });
        reader.readAsDataURL(file);
    }
});



$(document).ready(function () {
    function hove($id) {
        $(`#${$id}`).css('display', 'block');
    }
});


$(document).ready(function () {
    $('#print-btn').click(function () {
        // Save the current content of the body
        var originalContent = $('body').html();

        // Get the bond paper content
        var bondPaperContent = $('.bond-paper').html();

        // Replace the body content with the bond paper content
        $('body').html(bondPaperContent);

        // Print the bond paper content
        window.print();

        // Restore the original body content
        $('body').html(originalContent);
    });
});

$('.accept_button').on("click", function () {
    var button = $(this);
    button.prop('disabled', true).html("<i class='fas fa-spinner fa-spin p-0 m-0 me-1'></i> Sending Email...");
})

$('.reject_button').on("click", function () {
    var button = $(this);
    button.prop('disabled', true).html("<i class='fas fa-spinner fa-spin  p-0 m-0 me-1'></i> Sending Email...");
})





function CreatePDFfromHTML() {
    var yow = document.getElementById("bond-paper");
    yow.style.display = "block";
    var HTML_Width = 297;
    var HTML_Height = 210;
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + top_left_margin * 1.5;
    var PDF_Height = PDF_Width * 1.3 + top_left_margin * 1.5;
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height - 10; // reduce the height by 60

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#pdf")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF("p", "pt", [PDF_Width, PDF_Height]);
        pdf.addImage(
            imgData,
            "JPG",
            top_left_margin,
            top_left_margin,
            canvas_image_width,
            canvas_image_height
        );
        for (var i = 1; i <= totalPDFPages; i++) {
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(
                imgData,
                "JPG",
                top_left_margin,
                -(PDF_Height * i) + top_left_margin * 4,
                canvas_image_width,
                canvas_image_height
            );
        }
        pdf.save("Thesis Management System");
        $("#pdf").hide();
    });
}