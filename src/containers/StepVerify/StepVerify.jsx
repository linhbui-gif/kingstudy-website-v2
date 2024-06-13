import Steps from "@/components/Step";
import React, { useState } from "react";
import SteoUpload from "./StepUpload";
import { ModulePaths } from "@/routers/constants";
import { ETypeNotification } from "@/common/enums";
import { showNotification } from "@/utils/function";
import StepInformation from "./StepInformation";
import StepStatus from "./StepStatus";
import StepUpload from "./StepUpload";

const StepVerifyCompany = () => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });

  const dataStep = [
    {
      id: "1",
      children: (
        <StepInformation onNext={(data) => handleNextStep("2", data)} />
      ),
    },
    {
      id: "2",
      children: (
        <StepUpload
          onNext={(data) => handleNextStep("3", data)}
          widthModify={"w-full h-full"}
          name={"Step2"}
          className={"Upload-company"}
        />
      ),
    },
    {
      id: "3",
      children: <StepStatus link={`${ModulePaths.MyProfile}`} />,
    },
  ];

  const handleNextStep = (keyStep, data) => {
    const changedStep = dataStep.find((option) => option.id === keyStep);
    setStepState({
      ...stepState,
      currentStep: changedStep,
      data: { ...stepState.data, ...data },
    });
  };


  return (
    <div className={"mt-[39px] mb-[32px]"}>
      <div className={"p-[24px] rounded-[8px] bg-Tailwind/slate/400"}>
        <Steps
          registerStore={true}
          lineWidth="6rem"
          title={"Step Account"}
          options={dataStep}
          value={stepState.currentStep}
          onChange={(stepChanged) =>
            setStepState({ ...stepState, currentStep: stepChanged })
          }
          className={"h-full"}
        />
      </div>
    </div>
  );
};

export default StepVerifyCompany;
