import React, { useEffect, useState, useCallback } from "react";

export default React.memo(function Notification({
    show,
    message,
    onClose,
    type,
    duration = 3000,
}) {
    const [isVisible, setIsVisible] = useState(show);

    const closeNotification = useCallback(() => {
        setIsVisible(false);
        setTimeout(onClose, 300); // Laisse le temps à la transition de s'exécuter avant de fermer
    }, [onClose]);

    useEffect(() => {
        if (show) {
            setIsVisible(true);
            const timer = setTimeout(closeNotification, duration);
            return () => clearTimeout(timer);
        }
    }, [show, closeNotification, duration]);

    const bgColor = type === "success" ? "bg-green-500" : "bg-red-500";
    const opacityLevel = isVisible ? "opacity-100" : "opacity-0";
    const notificationStyle = `fixed top-5 right-5 z-50 transition-opacity duration-300 ${opacityLevel}`;

    if (!show && !isVisible) return null;

    return (
        <div className={notificationStyle}>
            <div className={`${bgColor} text-white shadow-lg rounded-lg p-4`}>
                <p>{message}</p>
            </div>
        </div>
    );
});
