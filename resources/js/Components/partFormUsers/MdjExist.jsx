import { useState } from "react";

export default function MdjExist({ mdjs, onChange }) {
    const [isMdjExist, setIsMdjExist] = useState(false);

    const handleCheckboxChange = (e) => {
        setIsMdjExist(e.target.checked);
        onChange(e); // Passe la valeur de la checkbox au parent
    };

    return (
        <div className="text-white mt-4">
            <label className="flex items-center">
                <input
                    type="checkbox"
                    id="mdjExist"
                    name="mdjExist"
                    checked={isMdjExist}
                    onChange={handleCheckboxChange}
                />
                <span className="ml-2">
                    Attribuer l'utilisateur à une maison de jeunes existante
                </span>
            </label>
            {isMdjExist && (
                <div className="mt-4">
                    <label htmlFor="mjExist">
                        Sélectionnez une maison de jeunes
                    </label>
                    <select
                        id="mjExist"
                        name="mjExist"
                        className="mt-1 block w-50% text-black"
                        onChange={onChange}
                    >
                        <option value="">Choisir une maison de jeunes</option>
                        {mdjs.map((mdj) => (
                            <option key={mdj.id} value={mdj.id}>
                                {mdj.name}
                            </option>
                        ))}
                    </select>
                </div>
            )}
        </div>
    );
}
