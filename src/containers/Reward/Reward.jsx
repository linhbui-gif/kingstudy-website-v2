import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';

const Reward = () => {
  return (
    <section className={'bg-style-10 lg:py-[7rem] py-[2rem]'}>
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
              100% visa <br className={'block md:hidden'} /> thành công
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
              2500+ <br className={'block md:hidden'} /> đối tác
            </span>
          </div>
          <div
            className={
              'flex items-center md:flex-row flex-col justify-center lg:justify-normal md:gap-[2.4rem]'
            }
          >
            <Icon
              className={'md:w-auto w-[2.7rem]'}
              name={EIconName.StudyAboard}
              color={EIconColor.WHITE}
            />
            <span
              className={
                'md:text-title-24 text-body-14 text-style-5 md:text-left text-center'
              }
            >
              130 tỷ <br className={'block md:hidden'} /> học bổng
            </span>
          </div>
        </div>
      </Container>
    </section>
  );
};
export default Reward;
