const TagCountry = ({ value, item, onChange }) => {
  return (
    <div
      className={`relative w-[150px]  md:w-auto cursor-pointer text-body-16 text-style-12 leading-7 py-[0.5rem] px-[1.2rem] ${
        value && value.value === item.value ? 'font-bold' : ''
      }`}
      onClick={() => {
        onChange?.(item);
      }}
    >
      {value && value.value === item.value && (
        <div className="text-orange absolute bottom-[100%] after:absolute after:content-[''] after:bottom-[15px] after:w-[3.1rem]  after:h-[0.1rem] after:bg-orange after:top-[50%] after:translate-y-[-50%] after:left-[50%] after:translate-x-[80%]">
          [07]
        </div>
      )}
      {item.label}
    </div>
  );
};
export default TagCountry;
