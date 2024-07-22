import { Col, Row } from 'antd';

import Container from '@/containers/Container';
import InstructorCard from '@/containers/Instructor/InstructorCard';

const Instructor = ({ title }) => {
  return (
    <div className={'py-[9rem]'}>
      <Container>
        <h2
          className={
            'lg:text-title-36 text-[2rem] font-[700] text-style-7 mb-[3rem] text-center'
          }
        >
          {title}
        </h2>
        <Row gutter={[24, 24]}>
          {[1, 2, 3, 4].map((element) => {
            return (
              <Col lg={{ span: 6 }} span={24} key={element}>
                <InstructorCard />
              </Col>
            );
          })}
        </Row>
      </Container>
    </div>
  );
};
export default Instructor;
