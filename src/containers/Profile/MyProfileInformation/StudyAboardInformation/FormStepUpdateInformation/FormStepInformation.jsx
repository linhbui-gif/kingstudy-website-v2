const FormStepInformation = ({ setIsUpdateToggle }) => {
  return (
    <div>
      Form step
      <span onClick={() => setIsUpdateToggle(false)}>Submit</span>
    </div>
  );
};
export default FormStepInformation;
