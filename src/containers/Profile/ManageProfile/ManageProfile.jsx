import { Col, Row } from 'antd';

const ManageProfile = () => {
  return (
    <div className={'px-[2rem]'}>
      <div className={'border border-style-8 border-solid'}>
        <div
          className={'text-title-20 bg-style-10 text-white p-[1.5rem_1.6rem]'}
        >
          Thông tin của bạn
        </div>
        <div>
          <Row gutter={[20, 20]} className={'p-[2rem]'}>
            <Col span={12}>
              <span>Tên của bạn: </span>
              <strong>buiq aug linh</strong>
            </Col>
            <Col span={12}>
              <span>Tên của bạn: </span>
              <strong>buiq aug linh</strong>
            </Col>
            <Col span={12}>
              <span>Tên của bạn: </span>
              <strong>buiq aug linh</strong>
            </Col>
            <Col span={12}>
              <span>Tên của bạn: </span>
              <strong>buiq aug linh</strong>
            </Col>
            <Col span={12}>
              <span>Tên của bạn: </span>
              <strong>buiq aug linh</strong>
            </Col>
          </Row>
        </div>
      </div>
      <div className={'border border-style-8 border-solid mt-[2rem]'}>
        <div
          className={'text-title-20 bg-style-10 text-white p-[1.5rem_1.6rem]'}
        >
          Thông tin hồ sơ
        </div>
        <div>
          <Row gutter={[20, 20]} className={'p-[2rem]'}>
            <Col span={24} className={'text-title-20'}>
              Hồ sơ học thuật
            </Col>
            <Col span={12}>
              <div>Hồ so 1</div>
            </Col>
          </Row>
          <Row gutter={[20, 20]} className={'p-[2rem]'}>
            <Col span={24} className={'text-title-20'}>
              Hồ sơ cá nhân
            </Col>
            <Col span={12}>
              <div>Hồ so 1</div>
            </Col>
          </Row>
          <Row gutter={[20, 20]} className={'p-[2rem]'}>
            <Col span={24} className={'text-title-20'}>
              Hồ sơ tài chính
            </Col>
            <Col span={12}>
              <div>Hồ so 1</div>
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
};
export default ManageProfile;
