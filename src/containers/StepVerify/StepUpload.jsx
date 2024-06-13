import React from "react";
import { useState } from "react";
import ButtonComponent from "@/components/Button";
import { Col, Form, Row } from "antd";
import Input from "@/components/Input";

const StepUpload = ({ onNext }) => {
  const [selected] = useState(null);
  return (
    <div>
      <Form layout="vertical">
        <Row gutter={[24, 24]}>
          <Col span={24}>
            <div className="text-[15px] font-[600] text-black mt-[20px]">
              {"Step Upload"}
            </div>
            <Form.Item
              name="name"
              label={"Tên File"}
              className="text-gray text-[13px] mt-[8px]"
            >
              <Input className="" />
            </Form.Item>
            <Form.Item name="phone" label={"Phone"}>
              <Input numberic />
            </Form.Item>
            <ButtonComponent
              title={"NEXT"}
              className="primary"
              onClick={() => onNext(selected)}
            />
          </Col>
        </Row>
      </Form>
    </div>
  );
};

export default StepUpload;
