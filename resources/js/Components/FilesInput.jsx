import React, { useState } from "react";

export default function FilesInput({ onFileChange }) {
    const [preview, setPreview] = useState(null);

    const handleFileChange = (event) => {
        const file = event.target.files[0];
        if (file && file.type.startsWith("image")) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setPreview(reader.result);
            };
            reader.readAsDataURL(file);
            onFileChange(file); // Inertia prendra automatiquement ce fichier et le traitera via FormData
        } else {
            setPreview(null);
            onFileChange(null);
        }
    };

    return (
        <div>
            <input type="file" accept="image/*" onChange={handleFileChange} />
            {preview && (
                <img
                    src={preview}
                    alt="Preview"
                    style={{ maxWidth: "300px", maxHeight: "300px" }}
                />
            )}
        </div>
    );
}
