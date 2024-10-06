import { Col, Row } from 'antd';
import Image from 'next/image';

import HaUyen from '@/assets/images/feedback/Website-FB-Hà-Uyên.jpg';
import Khanhan from '@/assets/images/feedback/Website-FB-Khánh-An.jpg';
import TranLeQuan from '@/assets/images/feedback/Website-FB-Lê-Quân.jpg';
import Minhnghia from '@/assets/images/feedback/Website-FB-Minh-Nghĩa.jpg';
import Quocbao from '@/assets/images/feedback/Website-FB-Quốc-Bảo.jpg';
import QuynhHuong from '@/assets/images/feedback/Website-FB-Quỳnh-Hương.jpg';
import ThuyDung from '@/assets/images/feedback/Website-FB-Thùy-Dung.jpg';
import TrungHieu from '@/assets/images/feedback/Website-FB-Trung-Hiếu.jpg';
import Tick from '@/assets/images/Tick.png';
import Carousels from '@/components/Carousels';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
const Feedback = () => {
  const students = [
    {
      id: 1,
      name: 'Trần Lê Quân',
      url: TranLeQuan,
      scholarship: 'Học bổng 10.000 AUD - Monash University',
      title: 'Giảng viên ân cần !',
      desc: 'Điều khiến mình quyết định đồng hành cùng KingStudy để chuẩn bị hồ sơ du học là bởi sự chuyên nghiệp của KingStudy. Với tất cả những thành tựu mình đạt được, mình cũng phải cảm ơn chị Linh, anh Tú và KingStudy rất nhiều. Nếu có cơ hội được đồng hành cùng anh chị trong tương lai thì mình rất sẵn lòng!\n',
      alt: 'Trần Lê Quân anh ấy có một giảng viên ân cần và tận tâm là anh Minh ',
    },
    {
      id: 2,
      name: 'TRẦN KHÁNH AN',
      url: Khanhan,
      scholarship: 'Học bổng 35% - University of Technology Sydney',
      title: 'Giảng viên ân cần !',
      desc: '3 từ để nói về KingStudy là nhanh chóng - uy tín - nhiệt tình. Trong quá trình làm việc các thông tin đều được xử lý nhanh chóng. Về độ uy tín thì KingStudy hiện đang là đối tác với hơn 3000 trường trên toàn thế giới. Và từ nhiệt tình dành cho anh Tú - luôn sẵn sàng giải đáp cho mình mọi câu hỏi và vạch ra cho mình một lộ trình rõ ràng.\n',
      alt: 'Trần Lê Quân anh ấy có một giảng viên ân cần và tận tâm là anh Minh ',
    },
    {
      id: 3,
      name: 'NGUYỄN MINH NGHĨA',
      url: Minhnghia,
      scholarship: 'Học bổng 80% - Northern Kentucky University',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Trong quá trình apply học bổng em gần như không gặp phải bất cứ khó khăn nào và mọi quá trình đều diễn ra suôn sẻ nhờ có sự hỗ trợ của các anh chị của KingStudy. Cảm ơn các anh chị đặc biệt là chị Vy và anh Tú đã luôn giúp đỡ em rất nhiệt tình trong quá trình em làm hồ sơ. Anh chị rất thân thiện và luôn tư vấn cho em một cách rất ân cần và chi tiết để nên em cũng rất yên tâm trong suốt quá trình làm hồ sơ du học của mình. Cảm ơn anh chị đã hỗ trợ để em có được kết quả như ngày hôm nay, chúc KingStudy ngày càng phát triển và có thêm nhiều thành công hơn nữa.',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
    {
      id: 4,
      name: 'NGUYỄN KIM HÀ UYÊN',
      url: HaUyen,
      scholarship: 'Toronto Metropolitan University',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Đối với mình, việc chọn KingStudy là bước đệm đầu tiên cho hành trình du học là một quyết định không bao giờ hối hận. Ngoài lời cảm ơn, em vô cùng biết ơn khi các anh chị luôn đồng hành cùng em. Các bạn có thể yên tâm gửi gắm niềm tin vào KingStudy để yên tâm xách balo lên và đi sang miền đất hứa.\n',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
    {
      id: 5,
      name: 'ĐỖ HOÀNG QUỲNH HƯƠNG',
      url: QuynhHuong,
      scholarship: 'Học bổng 50% - University of Lincoln',
      title: 'Giảng viên ân cần !',
      desc: 'Em cảm thấy rất may mắn vì đã biết đến KingStudy và có KingStudy đồng hành với em trong quá trình hoàn thành hồ sơ du học. Em xin cảm ơn chị Linh, chị Vy, chị Thu Phương và KingStudy đã hỗ trợ em hết mình. Chúc KingStudy ngày càng giúp đỡ nhiều bạn du học sinh chạm tay đến giấc mơ của mình.\n',
      alt: 'Trần Lê Quân anh ấy có một giảng viên ân cần và tận tâm là anh Minh ',
    },
    {
      id: 6,
      name: 'LÊ THỊ THUỲ DUNG',
      url: ThuyDung,
      scholarship: 'Học bổng 3.000 GBP - University of Exeter',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Điều mà mình thích nhất ở KingStudy là sự nhiệt tình của tất cả mọi người, anh chị rất kiên nhẫn hướng dẫn mình từng bước một. Cảm ơn mọi người đã đồng hành cùng mình trong suốt quá trình này đặc biệt là anh Tú, chị Phương và chị Vy - những người đã trực tiếp hỗ trợ mình. Chúc KingStudy ngày càng phát triển và thành công hơn nữa.\n',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
    {
      id: 7,
      name: 'HOÀNG TRUNG HIẾU',
      url: TrungHieu,
      scholarship:
        'Học bổng 10,000 GBP - University of Strathclyde và Học bổng 50% - University of Liverpool',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Sau khi tìm hiểu em thấy các bạn sinh viên đang theo học tại ngôi trường Strathclyde mà em mong muốn đã từng làm việc với KingStudy khá nhiều nên em đã lựa chọn KingStudy thay vì các trung tâm khác. Trong quá trình làm việc anh chị đã hỗ trợ em rất nhiệt tình dù là thời gian nghỉ cuối tuần nên em rất hài lòng với dịch vụ cũng như sự tận tâm, chuyên nghiệp của anh chị.\n',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
    {
      id: 8,
      name: 'ĐỖ QUỐC BẢO',
      url: Quocbao,
      scholarship: 'Học bổng maximum 30% - University Of Amsterdam',
      title: 'Trải nghiệm tuyệt vời !',
      desc: 'Trước khi đến với KingStudy, việc du học với mình cũng khá xa vời vì mình cũng không rõ quá trình này cần làm hay chuẩn bị những gì nhưng khi gặp anh Tú, chị Linh và chị Vy mọi thứ rõ ràng và việc du học dễ dàng hơn nếu có sự chuẩn bị kỹ lưỡng. Mình rất biết ơn các anh chị và KingStudy đã đồng hành cùng mình trong suốt quá trình chuẩn bị hồ sơ này.\n',
      alt: 'Nguyễn Hồng Chuyên đã chạm tay được tới giấc mơ Mỹ với Kingstudy ',
    },
  ];
  return (
    <section className={'lg:py-[15rem] py-[3rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24}>
            <h2
              className={
                'lg:mb-[5rem] sm:text-title-36 text-[2rem] font-bold text-center leading-[120%] lg:text-style-7  '
              }
            >
              Học Viên Nói gì Về KingStudy
            </h2>
          </Col>
        </Row>
        <Carousels
          className={'feedback-carousel'}
          autoplay={true}
          slidesToShow={3}
          slidesToScroll={3}
          dots
          infinite={true}
          responsive={[
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: false,
                dots: false,
                autoplay: true,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 1.1,
                slidesToScroll: 1,
                autoplay: true,
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
                  'student-feedback bg-style-24 p-[1.6rem] lg:p-[3rem] mr-[2.4rem] lg:mr-[3rem] flex flex-1 flex-col'
                }
              >
                <div className="flex justify-between lg:mb-[3rem]">
                  <div className="flex gap-x-[1rem] lg:gap-x-[2rem]">
                    <div className="w-[6.8rem] lg:w-[6.5rem] h-[6.5rem]">
                      <Image
                        quality={100}
                        className={
                          'aspect-[48/65] lg:aspect-[65/65] object-contain rounded-full'
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
                <div className="lg:mt-[0.28rem] flex flex-1 flex-col">
                  <h3 className="mb-0 text-style-10 text-body-18 leading-[140%]">
                    {student.title}
                  </h3>
                  <p className="text-style-12 text-body-16 leading-[140%] my-[2rem]">
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
