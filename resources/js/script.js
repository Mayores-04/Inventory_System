// Safely initialize inventory from localStorage
let inventory = JSON.parse(localStorage.getItem('inventory')) || [];

// Function to display inventory items in the table
function displayInventory() {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = ''; // Clear table before rendering

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

// Function to add a new item to the inventory
function addItem(event) {
    event.preventDefault();

    const itemName = document.getElementById('itemName').value.trim();
    const itemQuantity = parseInt(document.getElementById('itemQuantity').value);

    if (!itemName || isNaN(itemQuantity) || itemQuantity < 1) {
        alert('Please enter a valid item name and quantity (min: 1).');
        return;
    }

    // Check if the item already exists in inventory
    const existingItemIndex = inventory.findIndex(item => item.name.toLowerCase() === itemName.toLowerCase());

    if (existingItemIndex !== -1) {
        // Update quantity if item exists
        inventory[existingItemIndex].quantity += itemQuantity;
    } else {
        // Add new item
        inventory.push({ name: itemName, quantity: itemQuantity });
    }

    // Save to localStorage
    localStorage.setItem('inventory', JSON.stringify(inventory));
    let inventory = JSON.parse(localStorage.getItem('inventory')) || [];
    if (!Array.isArray(inventory)) inventory = [];
    
    // Reset form fields
    document.getElementById('itemForm').reset();
    console.log(inventory);
    // Update table
    displayInventory();
}

// Function to delete an item from the inventory
function deleteItem(index) {
    if (confirm("Are you sure you want to delete this item?")) {
        inventory.splice(index, 1);
        localStorage.setItem('inventory', JSON.stringify(inventory));
        displayInventory();
    }
}

// Event Listener for form submission
document.getElementById('itemForm').addEventListener('submit', addItem);

// Display inventory on page load
displayInventory();
