import { Col, Row } from 'antd';
import Image from 'next/image';

import DaoYenNhi from '@/assets/images/student-dao-yen-nhi.webp';
import NguyenHongChuyen from '@/assets/images/student-nguyen-hong-chuyen.webp';
import TranLeQuan from '@/assets/images/student-tran-le-quan.webp';
import Tick from '@/assets/images/Tick.png';
import Carousels from '@/components/Carousels';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
const Feedback = () => {
  const students = [
    {
      id: 1,
      name: 'Đào Yến Nhi',
      url: DaoYenNhi,
      scholarship: 'Học bổng 10.000AUD Monash University',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Mình đặc biệt biết ơn anh Minh và KingStudy khi đã xuất hiện với tư cách là một người thầy, một người đồng hành cùng mình trên con  đường du học này. Mình đã tham khảo qua khá nhiều trung tâm du học nhưng vẫn ưng ý nhất với KingStudy.',
      alt: 'Đào Yến Nhi có mội trải nghiệm tuyệt vời và biết ơn  với anh Minh và Kingstudy ',
    },
    {
      id: 2,
      name: 'Trần Lê Quân',
      url: TranLeQuan,
      scholarship: 'Học bổng 9.000 GBP - University of Strathclyde ',
      title: 'Giảng viên ân cần !',
      desc: 'Điều khiến mình quyết định đồng hành cùng KingStudy để chuẩn bị hồ sơ du học là bởi sự chuyên nghiệp của KingStudy. Mình cũng cảm ơn chị Linh, anh Tú và KingStudy rất nhiều.',
      alt: 'Trần Lê Quân anh ấy có một giảng viên ân cần và tận tâm là anh Minh ',
    },
    {
      id: 3,
      name: 'Nguyễn Hồng Chuyên',
      url: NguyenHongChuyen,
      scholarship: 'Miami University is ranked as a top public university. ',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Chỉ một thời gian ngắn, với như nhiệt tình và tận tâm của các anh chị ở KingStudy, mình đã chạm tay được với “giấc mơ Mỹ” một các vô cùng suôn sẻ. Xin gửi tới KingStudy một điểm 10 về chất lượng và dịch vụ.',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
    {
      id: 4,
      name: 'Nguyễn Hồng Chuyên',
      url: NguyenHongChuyen,
      scholarship: 'Miami University is ranked as a top public university. ',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Chỉ một thời gian ngắn, với như nhiệt tình và tận tâm của các anh chị ở KingStudy, mình đã chạm tay được với “giấc mơ Mỹ” một các vô cùng suôn sẻ. Xin gửi tới KingStudy một điểm 10 về chất lượng và dịch vụ.',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
    {
      id: 5,
      name: 'Trần Lê Quân',
      url: TranLeQuan,
      scholarship: 'Học bổng 9.000 GBP - University of Strathclyde ',
      title: 'Giảng viên ân cần !',
      desc: 'Điều khiến mình quyết định đồng hành cùng KingStudy để chuẩn bị hồ sơ du học là bởi sự chuyên nghiệp của KingStudy. Mình cũng cảm ơn chị Linh, anh Tú và KingStudy rất nhiều.',
      alt: 'Trần Lê Quân anh ấy có một giảng viên ân cần và tận tâm là anh Minh ',
    },
    {
      id: 6,
      name: 'Nguyễn Hồng Chuyên',
      url: NguyenHongChuyen,
      scholarship: 'Miami University is ranked as a top public university. ',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Chỉ một thời gian ngắn, với như nhiệt tình và tận tâm của các anh chị ở KingStudy, mình đã chạm tay được với “giấc mơ Mỹ” một các vô cùng suôn sẻ. Xin gửi tới KingStudy một điểm 10 về chất lượng và dịch vụ.',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
  ];
  return (
    <section className={'lg:py-[7rem] py-[3rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24}>
            <h2
              className={
                '  sm:text-title-36 text-[2rem] font-bold text-center leading-[120%] lg:text-style-7  '
              }
            >
              Học Viên <br /> Nói gì Về KingStudy
            </h2>
          </Col>
        </Row>
        <Carousels
          className={'feedback-carousel'}
          autoplay
          slidesToShow={3}
          slidesToScroll={3}
          dots
          infinite={false}
          responsive={[
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: false,
                dots: false,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 1.1,
                slidesToScroll: 1,
                autoplay: false,
                infinite: false,
                dots: false,
              },
            },
          ]}
        >
          {students.map((student) => (
            <div className="student" key={student.id}>
              <div
                className={
                  'bg-style-24 p-[1.6rem] lg:p-[2.4rem] mr-[2.4rem] lg:mx-[1.2rem]'
                }
              >
                <div className="flex justify-between">
                  <div className="flex gap-x-[1rem] lg:gap-x-[2rem]">
                    <div className="w-[6.8rem] lg:w-[6.5rem] h-[6.5rem]">
                      <Image
                        quality={100}
                        className={
                          'aspect-[48/65] lg:aspect-[65/65] object-contain '
                        }
                        src={student.url}
                        alt={`${student.alt}`}
                        layout={'responsive'}
                        loading={'lazy'}
                      />
                    </div>
                    <div>
                      <h3 className=" mb-0 text-style-7 text-body-18 leading-[140%] ">
                        {student.name}
                      </h3>
                      <p className="text-style-12 text-body-16 leading-[140%]">
                        {student.scholarship}
                      </p>
                    </div>
                  </div>
                  <div className="lg:w-[5rem] h-[5rem] w-[9rem]">
                    <Image
                      quality={100}
                      className={
                        'aspect-[70/48] lg:aspect-[126/119] object-contain'
                      }
                      src={Tick}
                      alt={'Dấu tick biển hiện sự hài lòng'}
                      layout={'responsive'}
                      loading={'lazy'}
                    />
                  </div>
                </div>
                <div className="lg:mt-[0.28rem]">
                  <h3 className="mb-0 text-style-10 text-body-18 leading-[140%]">
                    {student.title}
                  </h3>
                  <p className="text-style-12 text-body-16 leading-[140%] my-[1.6rem]">
                    {student.desc}
                  </p>
                </div>
                <div className="flex ">
                  {Array(5)
                    .fill(0)
                    .map((_, index) => (
                      <Icon key={index} name={EIconName.Star} />
                    ))}
                </div>
              </div>
            </div>
          ))}
        </Carousels>
      </Container>
    </section>
  );
};
export default Feedback;
