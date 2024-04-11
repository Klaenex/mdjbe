import TextInput from "../TextInput";
import TextArea from "../TextArea";

export default function BaseMdj({ data, onChange }) {
    return (
        <div>
            <h3 className="text-white text-2xl">
                Information générale de la mj
            </h3>
            <div className="text-white">
                <label htmlFor="name">Nom</label>
                <TextInput
                    name="name"
                    type="text"
                    id="name"
                    value={data.name || ""}
                    className="mt-1 block w-full"
                    onChange={onChange}
                />
            </div>
            <div className="text-white">
                <label htmlFor="tagline">Phrase d'accroche</label>
                <TextInput
                    name="tagline"
                    type="text"
                    id="tagline"
                    value={data.tagline || ""}
                    className="mt-1 block w-full"
                    onChange={onChange}
                />
            </div>
            <div>
                <div className="text-white">
                    <label htmlFor="location">Situation et localisation</label>
                    <TextArea
                        name="location"
                        id="location"
                        value={data.location || ""}
                        className="mt-1 block w-full"
                        onChange={onChange}
                    />
                </div>
                <div className="text-white">
                    <label htmlFor="objective">
                        Principaux enjeux et objectif
                    </label>
                    <TextArea
                        name="objective"
                        id="objective"
                        value={data.objective || ""}
                        className="mt-1 block w-full"
                        onChange={onChange}
                    />
                </div>
            </div>
        </div>
    );
}
