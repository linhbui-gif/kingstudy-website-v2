const TagFilter = ({ value, item, onChange }) => {
  return (
    <div
      className={`cursor-pointer text-body-16 py-[0.5rem] px-[1.2rem] ${
        value && value.value === item.value
          ? 'font-bold text-style-10'
          : 'text-[#575757]'
      }`}
      onClick={() => {
        onChange?.(item);
      }}
    >
      {item.label}(0)
    </div>
  );
};
export default TagFilter;
