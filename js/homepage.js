document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1;
    const pageContainer = document.getElementById("page-numbers");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");

    function renderPagination() {
        pageContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            let a = document.createElement("a");
            a.href = "?page=" + i;
            a.textContent = i;
            if (i === currentPage) {
                a.classList.add("active");
            }
            pageContainer.appendChild(a);
        }

        prevBtn.style.display = currentPage > 1 ? "inline-block" : "none";
        nextBtn.style.display = currentPage < totalPages ? "inline-block" : "none";
    }

    renderPagination();
});

