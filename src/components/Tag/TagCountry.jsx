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
        <div className="text-style-31 absolute bottom-[100%] after:absolute after:content-[''] after:bottom-[15px] after:w-[3.1rem]  after:h-[0.2rem] after:bg-style-31 after:top-[40%] after:left-[180%] after:translate-x-[-50%]">
          [06]
        </div>
      )}
      {item.label}
    </div>
  );
};
export default TagCountry;
