<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        nav {
            background: linear-gradient(to right, #6b21a8, #4338ca);
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        main {
            width: 100%;
            max-width: 6xl;
            margin-top: 6rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        footer {
            background: linear-gradient(to right, #6b21a8, #4338ca);
            width: 100%;
            padding: 1rem 0;
            margin-top: auto;
            text-align: center;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        table thead {
            background: linear-gradient(45deg, #4c1d95, #6b21a8);
            color: white;
            cursor: pointer;
        }
        table th, table td {
            padding: 1.25rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background: rgba(75, 85, 99, 0.1);
        }
        table tbody tr:hover {
            background: rgba(75, 85, 99, 0.2);
            transform: scale(1.02);
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .action-icons {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
        }
        .action-icons a {
            text-decoration: none;
        }
        .action-icons i {
            cursor: pointer;
            padding: 0.6rem;
            border-radius: 50%;
            font-size: 1.25rem;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .action-icons i:hover {
            transform: scale(1.2);
        }
        .fas.fa-eye {
            background: linear-gradient(45deg, #2563eb, #1e40af);
            color: white;
        }
        .fas.fa-eye:hover {
            background: linear-gradient(45deg, #1e3a8a, #1e40af);
        }
        .fas.fa-trash {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
            color: white;
        }
        .fas.fa-trash:hover {
            background: linear-gradient(45deg, #991b1b, #b91c1c);
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2.5rem;
            margin-bottom: 2rem;
            gap: 0.5rem;
        }
        .pagination button {
            padding: 0.5rem 1rem;
            background: linear-gradient(45deg, #4c1d95, #6b21a8);
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .pagination button:hover {
            background: linear-gradient(45deg, #6b21a8, #8b5cf6);
            transform: scale(1.1);
        }
        .pagination button:disabled {
            background: #ddd;
            cursor: not-allowed;
            color: #666;
        }

        #adminMenu {
            display: none;
        }
        #adminMenu.active {
            display: block;
        }
    </style>
</head>
<body>
<nav>
        <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center relative">
            <h1 class="text-2xl font-bold text-white mr-4">Guest Book Admin</h1>
            <div class="relative w-full max-w-sm">
                <input 
                    id="searchInput" 
                    type="text" 
                    placeholder="Search events..." 
                    class="w-full p-2 pl-10 border-100 border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            </div>
            <div class="relative">
                <i class="fas fa-ellipsis-v text-white text-2xl cursor-pointer" onclick="toggleMenu()"></i>
                <ul id="adminMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <h1 class="text-4xl font-bold text-white text-center mb-8">Available Events</h1>
        <div class="flex justify-end mt-6">
        <a href="create_event.php" class="relative inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white font-bold text-sm border border-green-500 shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 rounded-md group">
    <i class="fas fa-plus text-white mr-2 bg-green-500 p-1 rounded group-hover:bg-green-400 transition-all duration-300"></i>
    <span>Create Event</span>
</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th onclick="sortTable('id')">ID</th>
                    <th onclick="sortTable('name')">Nama Event</th>
                    <th onclick="sortTable('instansi')">Instansi</th>
                    <th onclick="sortTable('start')">Waktu Mulai</th>
                    <th onclick="sortTable('end')">Waktu Berakhir</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="pagination"></div>
    </main>

    <footer>
        <p>&copy; 2025 Guest Book Admin</p>
    </footer>

<script>
    const events = [
        { id: 1, name: "Job Fair Event", instansi: "BUMN", start: "2025-01-20 09:00", end: "2025-01-20 17:00" },
        { id: 2, name: "Exhibition", instansi: "ExArt", start: "2025-02-15 10:00", end: "2025-02-15 18:00" },
        { id: 3, name: "Edu Fair", instansi: "Oxford University", start: "2025-03-01 08:00", end: "2025-03-01 16:00" },
        { id: 4, name: "Tech Conference", instansi: "TechWorld", start: "2025-04-05 09:00", end: "2025-04-05 17:00" },
        { id: 5, name: "Art Gala", instansi: "ArtSpace", start: "2025-05-10 10:00", end: "2025-05-10 22:00" },
        { id: 6, name: "Science Expo", instansi: "SciOrg", start: "2025-06-15 09:00", end: "2025-06-15 16:00" },
    ];

    let currentSortColumn = '';
    let sortDirection = 'asc';
    let currentPage = 1;
    const rowsPerPage = 3;
    let filteredEvents = [...events];

    function renderTable(page) {
        const tableBody = document.querySelector("table tbody");
        tableBody.innerHTML = "";

        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        const paginatedEvents = filteredEvents.slice(startIndex, endIndex);

        paginatedEvents.forEach(event => {
            const row = `
                <tr>
                    <td>${event.id}</td>
                    <td>${event.name}</td>
                    <td>${event.instansi}</td>
                    <td>${event.start}</td>
                    <td>${event.end}</td>
                    <td class="action-icons">
                        <a href="main.php" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <i class="fas fa-trash" title="Delete"></i>
                    </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML("beforeend", row);
        });

        renderPagination();
    }

    function sortTable(column) {
        if (currentSortColumn === column) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            currentSortColumn = column;
            sortDirection = 'asc';
        }

        filteredEvents.sort((a, b) => {
            if (a[column] < b[column]) return sortDirection === 'asc' ? -1 : 1;
            if (a[column] > b[column]) return sortDirection === 'asc' ? 1 : -1;
            return 0;
        });

        renderTable(currentPage);
    }

    function renderPagination() {
        const paginationDiv = document.querySelector(".pagination");
        paginationDiv.innerHTML = "";

        const totalPages = Math.ceil(filteredEvents.length / rowsPerPage);

        const prevButton = document.createElement("button");
        prevButton.textContent = "« Previous";
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener("click", () => {
            currentPage--;
            renderTable(currentPage);
        });
        paginationDiv.appendChild(prevButton);

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.style.background = "#6b21a8";
            }
            pageButton.addEventListener("click", () => {
                currentPage = i;
                renderTable(currentPage);
            });
            paginationDiv.appendChild(pageButton);
        }

        const nextButton = document.createElement("button");
        nextButton.textContent = "Next »";
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener("click", () => {
            currentPage++;
            renderTable(currentPage);
        });
        paginationDiv.appendChild(nextButton);
    }

    function searchEvents(keyword) {
        filteredEvents = events.filter(event => 
            event.name.toLowerCase().includes(keyword.toLowerCase()) || 
            event.instansi.toLowerCase().includes(keyword.toLowerCase())
        );
        currentPage = 1;
        renderTable(currentPage);
    }

    document.getElementById("searchInput").addEventListener("input", (e) => {
        searchEvents(e.target.value);
    });

    document.addEventListener("DOMContentLoaded", () => {
        renderTable(currentPage);
    });

    function toggleMenu() {
            const menu = document.getElementById("adminMenu");
            menu.classList.toggle("active");
        }

        document.addEventListener("click", (event) => {
            const menu = document.getElementById("adminMenu");
            const isClickInside = event.target.closest(".fa-ellipsis-v");
            if (!isClickInside && menu.classList.contains("active")) {
                menu.classList.remove("active");
            }
        });
</script>

</body>
</html>