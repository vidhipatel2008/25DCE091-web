let students = [];
let currentPage = 1;
let perPage = 4;

fetch("students.json")
    .then(response => response.json())
    .then(data => {
        students = data;
        displayStudents();
    })
    .catch(error => {
        console.log("Error:", error);
    });

function displayStudents() {

    let search = document.getElementById("search").value.toLowerCase();
    let course = document.getElementById("course").value;
    let sort = document.getElementById("sort").value;

    let result = students.filter(student => {

        let matchSearch =
            student.name.toLowerCase().includes(search);

        let matchCourse =
            course === "all" || student.course === course;

        return matchSearch && matchCourse;
    });

    if (sort === "name") {
        result.sort((a, b) =>
            a.name.localeCompare(b.name)
        );
    }

    if (sort === "year") {
        result.sort((a, b) =>
            a.year - b.year
        );
    }

    let start = (currentPage - 1) * perPage;
    let end = start + perPage;

    let pageData = result.slice(start, end);

    let output = "";

    pageData.forEach(student => {

        output += `
            <div class="card">
                <h3>${student.name}</h3>
                <p><b>ID:</b> ${student.id}</p>
                <p><b>Course:</b> ${student.course}</p>
                <p><b>Year:</b> ${student.year}</p>
                <p><b>City:</b> ${student.city}</p>
            </div>
        `;
    });

    document.getElementById("students").innerHTML = output;

    let totalPages = Math.ceil(result.length / perPage);

    document.getElementById("page").innerHTML =
        "Page " + currentPage + " of " + totalPages;
}

document.getElementById("search").addEventListener(
    "input",
    function() {
        currentPage = 1;
        displayStudents();
    }
);

document.getElementById("course").addEventListener(
    "change",
    function() {
        currentPage = 1;
        displayStudents();
    }
);

document.getElementById("sort").addEventListener(
    "change",
    function() {
        displayStudents();
    }
);

function nextPage() {

    let totalPages = Math.ceil(
        students.length / perPage
    );

    if (currentPage < totalPages) {
        currentPage++;
        displayStudents();
    }
}

function previousPage() {

    if (currentPage > 1) {
        currentPage--;
        displayStudents();
    }
}