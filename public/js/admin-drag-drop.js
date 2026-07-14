document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("gallery-sortable-container");
    if (!container) return;

    let draggedItem = null;

    // Helper to initialize drag & drop event listeners
    function initDragAndDrop(item) {
        item.setAttribute("draggable", "true");

        item.addEventListener("dragstart", function (e) {
            draggedItem = item;
            setTimeout(() => item.classList.add("dragging"), 0);
            e.dataTransfer.effectAllowed = "move";
        });

        item.addEventListener("dragend", function () {
            draggedItem = null;
            item.classList.remove("dragging");
            updateGalleryOrder();
        });

        item.addEventListener("dragover", function (e) {
            e.preventDefault();
            const draggingEl = container.querySelector(".dragging");
            if (!draggingEl) return;
            
            const siblings = [...container.querySelectorAll(".gallery-item:not(.dragging)")];
            let nextSibling = siblings.find(sibling => {
                const box = sibling.getBoundingClientRect();
                // Check if cursor is past the middle of the sibling element horizontally/vertically
                return (e.clientX <= box.left + box.width / 2) && (e.clientY <= box.top + box.height / 2);
            });

            if (nextSibling) {
                container.insertBefore(draggingEl, nextSibling);
            } else {
                container.appendChild(draggingEl);
            }
        });
    }

    // Attach listeners to all items
    container.querySelectorAll(".gallery-item").forEach(item => {
        initDragAndDrop(item);
    });

    // Watch for dynamic insertions to the container (if we want to add new uploads visually)
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === 1 && node.classList.contains("gallery-item")) {
                    initDragAndDrop(node);
                    updateGalleryOrder();
                }
            });
        });
    });
    observer.observe(container, { childList: true });

    // Update hidden input with the current order of paths
    function updateGalleryOrder() {
        const paths = [];
        container.querySelectorAll(".gallery-item").forEach(item => {
            const path = item.getAttribute("data-path");
            if (path) paths.push(path);
        });
        
        let orderInput = document.getElementById("gallery_order");
        if (!orderInput) {
            orderInput = document.createElement("input");
            orderInput.type = "hidden";
            orderInput.id = "gallery_order";
            orderInput.name = "gallery_order";
            container.appendChild(orderInput);
        }
        orderInput.value = JSON.stringify(paths);
    }

    // Handle cover photo selection and deletion via event delegation
    container.addEventListener("click", function (e) {
        const makeCoverBtn = e.target.closest(".make-cover-btn");
        if (makeCoverBtn) {
            e.preventDefault();
            const item = makeCoverBtn.closest(".gallery-item");
            const path = item.getAttribute("data-path");
            
            // Set cover input value
            let coverInput = document.getElementById("cover_image");
            if (!coverInput) {
                coverInput = document.createElement("input");
                coverInput.type = "hidden";
                coverInput.id = "cover_image";
                coverInput.name = "cover_image";
                container.appendChild(coverInput);
            }
            coverInput.value = path;

            // Reset cover state for all siblings
            container.querySelectorAll(".gallery-item").forEach(el => {
                el.classList.remove("is-cover");
                const badge = el.querySelector(".cover-badge");
                if (badge) badge.classList.add("d-none");
            });

            // Set cover state for active item
            item.classList.add("is-cover");
            const badge = item.querySelector(".cover-badge");
            if (badge) badge.classList.remove("d-none");
        }

        // Handle delete/remove item
        const removeBtn = e.target.closest(".remove-gallery-item-btn");
        if (removeBtn) {
            e.preventDefault();
            const item = removeBtn.closest(".gallery-item");
            const path = item.getAttribute("data-path");
            
            // Add to the deletion queue input
            const deleteInput = document.createElement("input");
            deleteInput.type = "hidden";
            deleteInput.name = "remove_gallery[]";
            deleteInput.value = path;
            container.appendChild(deleteInput);

            // If the deleted item was the cover, clear the cover value
            if (item.classList.contains("is-cover")) {
                const coverInput = document.getElementById("cover_image");
                if (coverInput) coverInput.value = "";
            }

            item.remove();
            updateGalleryOrder();
        }
    });

    // Run initial calculation
    updateGalleryOrder();
});
