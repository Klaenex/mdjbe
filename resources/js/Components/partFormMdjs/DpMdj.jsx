export default function DpMdj({ dp, selectedDispositif, onChange }) {
    return (
        <>
            <label htmlFor="dispositifParticulier" className="text-white">
                Dispositif particulier
            </label>
            <select
                name="dispositif_particulier"
                id="dispositifParticulier"
                defaultValue={selectedDispositif || "none"}
                onChange={onChange}
            >
                <option value="none">Aucun</option>
                {dp.map((item) => (
                    <option key={item.id} value={item.id}>
                        {item.name}
                    </option>
                ))}
            </select>
        </>
    );
}
