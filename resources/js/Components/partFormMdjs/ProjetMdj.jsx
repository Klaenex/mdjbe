import { useState } from "react";
import TextInput from "../TextInput";

export default function ProjetMdj({ handleClose, addProject }) {
    const [projectName, setProjectName] = useState("");

    const handleAddProject = () => {
        if (projectName) {
            addProject(projectName);
            setProjectName("");
            handleClose();
        }
    };

    return (
        <div className="p-4 bg-white shadow-md rounded-lg">
            <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold">
                    Ajouter un Projet Porteur
                </h2>
                <button
                    onClick={handleClose}
                    className="text-red-500 hover:text-red-700 transition duration-150 ease-in-out"
                >
                    Fermer
                </button>
            </div>
            <div className="mb-4">
                <label
                    htmlFor="projetPorteur"
                    className="block text-sm font-medium text-gray-700"
                >
                    Nom du projet
                </label>
                <TextInput
                    id="projetPorteur"
                    type="text"
                    name="projetPorteur"
                    value={projectName}
                    onChange={(e) => setProjectName(e.target.value)}
                    className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>
            <button
                onClick={handleAddProject}
                className="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Ajouter
            </button>
        </div>
    );
}
