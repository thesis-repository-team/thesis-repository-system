// document.addEventListener("DOMContentLoaded", function () {
//     function loadData() {
//         let search = document.getElementById("search").value;
//         let department = document.getElementById("departmentFilter").value;
//         let year = document.getElementById("yearFilter").value;

//         fetch(
//             "{{ route('student.thesis.search') }}" +
//                 "?search=" +
//                 encodeURIComponent(search) +
//                 "&department=" +
//                 encodeURIComponent(department) +
//                 "&year=" +
//                 encodeURIComponent(year),
//         )
//             .then((response) => response.text())
//             .then((data) => {
//                 document.getElementById("studentTable").innerHTML = data;
//             })
//             .catch((error) => console.log(error));
//     }

//     document.getElementById("search").addEventListener("input", loadData);
//     document
//         .getElementById("departmentFilter")
//         .addEventListener("change", loadData);
//     document.getElementById("yearFilter").addEventListener("change", loadData);
// });



