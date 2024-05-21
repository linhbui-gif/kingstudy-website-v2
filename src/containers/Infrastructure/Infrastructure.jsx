import Tabs from '@/components/Tabs';
import Container from '@/containers/Container';

const Infrastructure = () => {
  const campusOptions = [
    {
      key: 'campus',
      title: 'Campus',
      children: (
        <div>
          <div>
            <p class="text-body-16">
              Anglia Ruskin University có 4 cơ sở, trong đó có 3 cơ sở chính và
              một cơ sở đối tác tại London. Các địa điểm này đều được trang bị
              cơ sở vật chất hiện đại, tân tiến để mang đến một trải nghiệm
              tuyệt vời cho sinh viên. Trong đó Chelmsford và Cambridge là hai
              cơ sở được xếp Top 10 Best Place In UK.
            </p>
            <p class="text-body-16">Cambridge Campus</p>
            <p class="text-body-16">
              Cambridge Campus được đầu tư hơn 100 triệu Bảng Anh vào cơ sở vật
              chất trong 5 năm qua và có kế hoạch đầu tư thêm 91 triệu bảng
              trong 5 năm tới.
            </p>
            <ul className="px-[2rem]">
              <li class="list-disc text-body-16">
                Cơ sở vật chất học tập chất lượng cao với một tòa án luật mô
                phỏng, phòng thí nghiệm khoa học pháp y và trường quay truyền
                hình.
              </li>
              <li class="list-disc text-body-16">
                Trung tâm khoa học chuyên dụng có các phòng thí nghiệm tâm lý
                học và sinh học phân tử, SuperLab 220 chỗ ngồi và 5 phòng hiện
                trường vụ án.
              </li>
              <li class="list-disc text-body-16">
                Thư viện mở cửa xuyên suốt 24/7 với sách, tài nguyên học tập
                trực tuyến và cơ sở công nghệ thông tin cũng như các không gian
                tự học.
              </li>
              <li class="list-disc text-body-16">
                Nhà hát Mumford và Phòng trưng bày Ruskin nổi tiếng với các
                triển lãm miễn phí.
              </li>
            </ul>
          </div>
          <div class="my-[4rem]">
            <h3 class="text-title-20 mb-[1rem]">Chương trình giảng dạy</h3>
            <p class="text-body-16">
              Các chương trình đào tạo tổ chức tại một số khoa và trường trực
              thuộc bao gồm:
            </p>
            <ul className="px-[2rem]">
              <li class="list-disc text-body-16">
                Khoa Nghệ thuật, Khoa học Xã hội và Nhân văn:
              </li>
              <li class="list-disc text-body-16">
                Khoa Sức khỏe, Giáo dục, Y tế và Chăm sóc Xã hội:
              </li>
              <li class="list-disc text-body-16">Khoa Kinh doanh và Luật:</li>
              <li class="list-disc text-body-16">Khoa Kinh doanh và Luật:</li>
            </ul>
          </div>
        </div>
      ),
    },
    {
      key: 'accommodation',
      title: 'Accommodation',
      children: (
        <div>
          <p className="text-body-16">Thông tin về cơ sở Chelmsford.</p>
        </div>
      ),
    },
  ];
  return (
    <section>
      <Container>
        <h2 className="text-title-20 leading-[120%]">Cơ Sở Vật Chất</h2>
        <Tabs options={campusOptions} defaultKey="campus" />
      </Container>
    </section>
  );
};
export default Infrastructure;
