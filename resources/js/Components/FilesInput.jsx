import React, { useState, useEffect } from "react";

export default function FilesInput({
    onFileChange,
    htmlFor,
    label,
    existingFileUrl,
}) {
    // Initialisez la prévisualisation avec l'URL de l'image existante, si disponible
    const [preview, setPreview] = useState(existingFileUrl);

    useEffect(() => {
        // Mettre à jour la prévisualisation si l'URL de l'image existante change
        setPreview(existingFileUrl);
    }, [existingFileUrl]);

    const handleFileChange = (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                // Mettez à jour l'aperçu pour le nouveau fichier sélectionné
                setPreview(reader.result);
                onFileChange(file);
            };
            reader.readAsDataURL(file);
        } else {
            // Réinitialisez la prévisualisation si aucun fichier n'est sélectionné
            setPreview(existingFileUrl);
            onFileChange(null);
        }
    };

    return (
        <div>
            <label htmlFor={htmlFor}>{label}</label>
            <input
                id={htmlFor}
                type="file"
                accept="image/*"
                onChange={handleFileChange}
            />

            {preview && (
                <img
                    src={preview}
                    alt={`Prévisualisation ${label}`}
                    style={{ maxWidth: "300px", maxHeight: "300px" }}
                />
            )}
        </div>
    );
}
