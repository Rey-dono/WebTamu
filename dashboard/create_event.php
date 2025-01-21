<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Event</title>
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
            width: 50%;
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
        table th, table td {
        padding: 0.75rem; /* Perkecil padding */
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 0.875rem; /* Perkecil ukuran font */
        }
    </style>
</head>
<body>
    <nav>
        <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center relative">
            <h1 class="text-2xl font-bold text-white">Formulir Event</h1>
        </div>
    </nav>

    <main>
        <h1 class="text-4xl font-bold text-white text-center mb-8">Tambah Event Baru</h1>

        <form id="eventForm" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama:</label>
                <input type="text" id="name" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Tanggal:</label>
                <input type="date" id="date" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="time" class="block text-gray-700 font-bold mb-2">Waktu:</label>
                <input type="text" id="time" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="e.g., 09:00 - 17:00" required>
            </div>

            <div class="mb-4">
                <label for="event" class="block text-gray-700 font-bold mb-2">Event:</label>
                <input type="text" id="event" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Tambahkan Event</button>
        </form>

       
    </main>

    <footer>
        <p>&copy; 2025 Formulir Event</p>
    </footer>

    <script>
        const events = [];
        let eventId = 1;

        document.getElementById("eventForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const name = document.getElementById("name").value;
            const date = document.getElementById("date").value;
            const time = document.getElementById("time").value;
            const event = document.getElementById("event").value;

            events.push({ id: eventId++, name, date, time, event });
            renderTable();

            this.reset();
        });

        function renderTable() {
            const tableBody = document.querySelector("table tbody");
            tableBody.innerHTML = "";

            events.forEach(event => {
                const row = `
                    <tr>
                        <td>${event.id}</td>
                        <td>${event.name}</td>
                        <td>${event.date}</td>
                        <td>${event.time}</td>
                        <td>${event.event}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML("beforeend", row);
            });
        }
    </script>
</body>
</html>
