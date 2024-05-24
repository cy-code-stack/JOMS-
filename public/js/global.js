function cancelConfirm(e) {
    // var jobId = e.target.getAttribute('data-form-id');
    // var form = document.getElementById('cancelForm');
    // form.action = form.action.replace(':id', jobId);


    var form = e.target.closest('form');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'

    }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
        }
    })
}

$(document).ready(function () {
    console.log('test');
    //Pop-up profile
    var popup = $('.profile-popup');

    $('.img-profile').click(function (e) {
        popup.toggle();
        e.stopPropagation(); // Stop the click event from propagating to the document
    });

    $(document).click(function (event) {
        if (!popup.is(event.target) && popup.has(event.target).length === 0) {
            popup.hide();
        }
    });

    //Admin Dashboard sort
    $('#status-select').change(function () {

        var form = $(this).closest('form');
        form.submit();
        // console.log(form);
    });
    
     //Admin Dashboard sort
    $('#status-selectArea').change(function () {
        var form = $(this).closest('form');
        form.submit();
        // console.log(form);
    });
    
     //Admin Dashboard sort
    $('#month-select').change(function () {
        var form = $(this).closest('form');
        form.submit();
  
    });
});

$(document).ready(function () {
    $(".rating i").click(function () {
        const value = $(this).data("value");
        $("#ratingValue").val(value);
        updateStarColors(value);
    });

    function updateStarColors(selectedValue) {
        $(".rating i").each(function () {
            const value = $(this).data("value");
            if (value <= selectedValue) {
                $(this).css("color", "gold"); // Change color for selected stars
            } else {
                $(this).css("color", "gray"); // Change color for unselected stars
            }
        });
    }
});



