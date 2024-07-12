import GuestLayout from "@/layouts/GuestLayout";
import Meta from "@/components/Meta";
import ProductComparisonTable from "@/containers/ProductComparisonTable";
import Container from "@/containers/Container";

const CompareList = () => {
  return (
    <div className={'py-[9rem]'}>
      <Container><ProductComparisonTable /></Container>
    </div>
  );
};
export default CompareList;
CompareList.getLayout = function (page) {
  return (
    <>
      <GuestLayout>
        <Meta title={'Danh sách so sánh'} />
        {page}
      </GuestLayout>
    </>
  );
};
