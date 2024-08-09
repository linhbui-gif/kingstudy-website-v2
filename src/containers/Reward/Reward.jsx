import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
import CountUp from "react-countup";

const Reward = () => {
  return (
    <section className={'bg-style-10 lg:py-[3.2rem] pb-[1.6rem]'}>
      <Container>
        <div className={'flex items-center justify-between'}>
          <div
            className={
              'flex items-center md:flex-row flex-col justify-center lg:justify-normal md:gap-[2.4rem]'
            }
          >
            <Icon className={'md:w-auto w-[2.7rem]'} name={EIconName.Visa} />
            <span
              className={
                'md:text-title-24 text-body-14 text-style-5 md:text-left text-center'
              }
            >
              <CountUp duration={10} end={100} />% visa <br className={'block md:hidden'} /> thành công
            </span>
          </div>
          <div
            className={
              'flex items-center md:flex-row flex-col justify-center lg:justify-normal md:gap-[2.4rem]'
            }
          >
            <Icon className={'md:w-auto w-[2.7rem]'} name={EIconName.Partner} />
            <span
              className={
                'md:text-title-24 text-body-14 text-style-5 md:text-left text-center'
              }
            >
              <CountUp duration={10} end={2500} />+ <br className={'block md:hidden'} /> đối tác
            </span>
          </div>
          <div
            className={
              'flex items-center md:flex-row flex-col justify-center lg:justify-normal md:gap-[2.4rem]'
            }
          >
            <Icon
              className={'md:w-auto w-[2.7rem] h-[5.5rem]'}
              name={EIconName.StudyAboard}
              color={EIconColor.WHITE}
            />
            <span
              className={
                'md:text-title-24 text-body-14 text-style-5 md:text-left text-center'
              }
            >
              <CountUp duration={10} end={130} /> tỷ <br className={'block md:hidden'} /> học bổng
            </span>
          </div>
        </div>
      </Container>
    </section>
  );
};
export default Reward;
