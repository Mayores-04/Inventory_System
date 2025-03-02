<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col items-center p-6 lg:p-8">

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg w-full max-w-3xl">
        <h1 class="text-3xl font-bold text-center mb-6">Inventory Management System</h1>

        <form id="itemForm" class="flex flex-col md:flex-row items-center justify-center gap-2 mb-4">
            <input type="text" id="itemName" placeholder="Item Name" required
                   class="border border-gray-300 p-2 rounded flex-grow">
            <input type="number" id="itemQuantity" placeholder="Quantity" min="1" required
                   class="border border-gray-300 p-2 rounded w-24">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Add Item
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-center">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">Item Name</th>
                    <th class="py-2 px-4 border-b">Quantity</th>
                    <th class="py-2 px-4 border-b">Action</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Inventory items will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let inventory = JSON.parse(localStorage.getItem('inventory')) || [];

        function displayInventory() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';  

            inventory.forEach((item, index) => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-100');

                row.innerHTML = `
                    <td class="py-2 px-4 border-b">${item.name}</td>
                    <td class="py-2 px-4 border-b">${item.quantity}</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition"
                                onclick="deleteItem(${index})">
                            Delete
                        </button>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        }

        function addItem(event) {
            event.preventDefault();

            const itemName = document.getElementById('itemName').value.trim();
            const itemQuantity = parseInt(document.getElementById('itemQuantity').value);

            if (!itemName || isNaN(itemQuantity) || itemQuantity < 1) {
                alert('Please enter a valid item name and quantity (min: 1).');
                return;
            }

            const existingItemIndex = inventory.findIndex(item => item.name.toLowerCase() === itemName.toLowerCase());

            if (existingItemIndex !== -1) {
                inventory[existingItemIndex].quantity += itemQuantity;
            } else {
                inventory.push({ name: itemName, quantity: itemQuantity });
            }

            localStorage.setItem('inventory', JSON.stringify(inventory));

            document.getElementById('itemForm').reset();
            displayInventory();
        }

        function deleteItem(index) {
            if (confirm("Are you sure you want to delete this item?")) {
                inventory.splice(index, 1);
                localStorage.setItem('inventory', JSON.stringify(inventory));
                displayInventory();
            }
        }

        document.getElementById('itemForm').addEventListener('submit', addItem);

        displayInventory();
    </script>

</body>
</html>
