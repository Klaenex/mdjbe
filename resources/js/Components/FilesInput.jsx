import React, { useState } from "react";

export default function FilesInput({
    onFileChange,
    htmlFor,
    label,
    existingFileUrl,
}) {
    const [preview, setPreview] = useState(existingFileUrl || null);

    const handleFileChange = (event) => {
        const file = event.target.files[0];
        console.log(event.target.files[0]);
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setPreview(reader.result);
                onFileChange(file);
            };
            reader.readAsDataURL(file);
        } else {
            setPreview(null);
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
                    alt="Preview"
                    style={{ maxWidth: "300px", maxHeight: "300px" }}
                />
            )}
        </div>
    );
}
