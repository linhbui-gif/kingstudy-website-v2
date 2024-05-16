const TagFilter = ({ value, item, onChange }) => {
  return (
    <div
      className={`border border-solid border-style-8 cursor-pointer text-body-16 py-[0.5rem] px-[1.2rem] rounded-sm ${
        value && value.value === item.value
          ? 'text-white font-bold bg-style-10'
          : 'text-[#575757]'
      }`}
      onClick={() => {
        onChange?.(item);
      }}
    >
      {item.label}
    </div>
  );
};
export default TagFilter;
