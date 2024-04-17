import React, { useState } from "react";

export default function FilesInput({ onFileSelect }) {
    const [preview, setPreview] = useState(null);

    // Handler pour les changements de fichier
    const handleFileChange = (event) => {
        const file = event.target.files[0];
        if (file && file.type.startsWith("image")) {
            // Mettre à jour la prévisualisation de l'image
            const reader = new FileReader();
            reader.onloadend = () => {
                setPreview(reader.result);
            };
            reader.readAsDataURL(file);

            onFileSelect(file);
        } else {
            setPreview(null);
            onFileSelect(null);
        }
    };

    return (
        <div>
            <input type="file" accept="image/*" onChange={handleFileChange} />
            {preview && (
                <img
                    src={preview}
                    alt="Image Preview"
                    style={{ maxWidth: "300px", maxHeight: "300px" }}
                />
            )}
        </div>
    );
}
