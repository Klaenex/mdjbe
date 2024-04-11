import TextInput from "../TextInput";

export default function AdressMdj({ data, onChange }) {
    return (
        <div className="text-white">
            <h3 className="text-white text-2xl">Adresse et contact</h3>
            <div>
                <div>
                    <label htmlFor="street">Rue</label>
                    <TextInput
                        name="street"
                        type="text"
                        value={data.street}
                        className="mt-1 block w-1/3"
                        onChange={onChange}
                    />
                </div>
                <div>
                    <label htmlFor="number">N°</label>
                    <TextInput
                        name="number"
                        type="text"
                        value={data.number}
                        className="mt-1 block w-1/3"
                        onChange={onChange}
                    />
                </div>
            </div>
            <div>
                <div>
                    <label htmlFor="city">Ville</label>
                    <TextInput
                        name="city"
                        type="text"
                        value={data.city}
                        className="mt-1 block w-1/3"
                        onChange={onChange}
                    />
                </div>
                <div>
                    <label htmlFor="postal_code">Code postal</label>
                    <TextInput
                        name="postal_code"
                        type="number"
                        value={data.postal_code}
                        className="mt-1 block w-1/3"
                        onChange={onChange}
                    />
                </div>
            </div>
            <div>
                <label htmlFor="tel">Téléphone</label>
                <TextInput
                    name="tel"
                    type="tel"
                    value={data.tel}
                    className="mt-1 block w-1/3"
                    onChange={onChange}
                />
            </div>
        </div>
    );
}
