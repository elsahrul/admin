const flashData = $('.flash-data').data('flashdata');

if (flashData) {
	Swal.fire({
		title: 'Berhasil',
		text: flashData,
		icon: 'success'
	});
}


//tombol hapus

// $('.tombol-hapus').on('click', function (e) {

//     e.preventDefault();
//     const href = $(this).attr('href');

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.location.href = href;
//         }
//     })
// });
