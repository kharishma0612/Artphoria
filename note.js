document.addEventListener("DOMContentLoaded", () => {
    const noteText = document.getElementById("noteText");
    const drawingCanvas = document.getElementById("drawingCanvas");
    const saveNoteButton = document.getElementById("saveNoteButton");
    const saveDrawingButton = document.getElementById("saveDrawingButton");
    const notesList = document.getElementById("notesList");
    async function getUserId() {
        try {
            const response = await fetch('get_user_id.php');
            const data = await response.json();
            return data.user_id;
        } catch (error) {
            console.error('Error fetching user ID:', error);
            return null;
        }
    }
    async function handleSaveNoteClick() {
        const text = noteText.value.trim();
        if (text) {
            const userId = await getUserId(); 
            if (userId !== null) {
                saveNoteToDatabase(text, userId);
                noteText.value = "";
            } else {
                console.error('User ID not available');
            }
        }
    }
    async function handleSaveDrawingClick() {
        const drawingDataUrl = drawingCanvas.toDataURL("image/png");
        if (drawingDataUrl) {
            const userId = await getUserId(); 
            if (userId !== null) {
                await saveDrawingToDatabase(drawingDataUrl, userId);
                clearCanvas(drawingCanvas);
            } else {
                console.error('User ID not available');
            }
        }
    }
    saveNoteButton.addEventListener("click", handleSaveNoteClick);
    saveDrawingButton.addEventListener("click", handleSaveDrawingClick);
    const canvas = document.getElementById("drawingCanvas");
    const context = canvas.getContext("2d");
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    const drawingHistory = [];
    canvas.addEventListener("mousedown", (e) => {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });

    canvas.addEventListener("mousemove", draw);

    canvas.addEventListener("mouseup", () => {
        isDrawing = false;
    });

    canvas.addEventListener("mouseout", () => {
        isDrawing = false;
    });
    function draw(e) {
        if (!isDrawing) return;

        context.strokeStyle = "#000";
        context.lineWidth = 2;
        context.lineCap = "round";

        context.beginPath();
        context.moveTo(lastX, lastY);
        context.lineTo(e.offsetX, e.offsetY);
        context.stroke();

        [lastX, lastY] = [e.offsetX, e.offsetY];
        drawingHistory.push(context.getImageData(0, 0, canvas.width, canvas.height));
    }
    function undo() {
        if (drawingHistory.length > 0) {
            drawingHistory.pop();
            clearCanvas(canvas);

            drawingHistory.forEach((step) => {
                context.putImageData(step, 0, 0);
            });
        }
    }
    const undoButton = document.getElementById("undoButton");
    undoButton.addEventListener("click", undo);
    function clearCanvas(canvas) {
        const context = canvas.getContext("2d");
        context.clearRect(0, 0, canvas.width, canvas.height);
    }
    function saveNoteToDatabase(note, userId) {
        fetch('save_note.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ note: note, user_id: userId }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error); 
        });
    }
    async function saveDrawingToDatabase(drawingDataUrl, userId) {
        try {
            const response = await fetch('save_drawing.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ drawingDataUrl: drawingDataUrl, user_id: userId }),
            });
            if (response.ok) {
                const data = await response.json();
                console.log(data); 
            } else {
                console.error('Failed to save drawing');
            }
        } catch (error) {
            console.error('Error:', error); 
        }
    }
    async function displayUserNotesAndDrawings() {
        const userId = await getUserId();
        if (userId !== null) {
            try {
                const response = await fetch('retrieve_notes_and_drawings.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user_id: userId, action: "retrieve" }),
                });
                if (response.ok) {
                    const data = await response.json();
                    notesList.innerHTML = '';
                    data.notes.forEach((note) => {
                        const noteElement = document.createElement('p');
                        noteElement.textContent = note.content;
                        notesList.appendChild(noteElement);
                    });
                    data.drawings.forEach((drawing) => {
                        const drawingElement = document.createElement('img');
                        drawingElement.src = drawing.image_data;
                        notesList.appendChild(drawingElement);
                    });
                } else {
                    console.error('Failed to retrieve notes and drawings');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        } else {
            console.error('User ID not available');
        }
    }

    document.addEventListener("DOMContentLoaded", displayUserNotesAndDrawings);
});
