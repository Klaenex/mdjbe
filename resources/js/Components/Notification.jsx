import React, { useEffect, useState } from "react";

export default function Notification({
    show,
    message,
    onClose,
    type = "success",
    duration = 3000,
}) {
    const [isVisible, setIsVisible] = useState(show);

    useEffect(() => {
        if (show) {
            setIsVisible(true); // Affiche la notification
            const timer = setTimeout(() => {
                setIsVisible(false); // Commence la transition de sortie
                setTimeout(onClose, 300); // Laisse le temps à la transition de s'exécuter avant de fermer
            }, duration);
            return () => clearTimeout(timer);
        }
    }, [show, onClose, duration]);

    // Déterminer la classe de couleur en fonction du type
    const bgColor = type === "success" ? "bg-green-500" : "bg-red-500";

    // Ajouter les styles de transition ici
    const notificationStyle = `fixed top-5 right-5 z-50 transition-opacity duration-300 ${
        isVisible ? "opacity-100" : "opacity-0"
    }`;

    if (!show && !isVisible) return null;

    return (
        <div className={notificationStyle}>
            <div className={`${bgColor} text-white shadow-lg rounded-lg p-4`}>
                <p>{message}</p>
            </div>
        </div>
    );
}
