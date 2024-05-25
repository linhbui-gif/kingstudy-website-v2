import { ETypeNotification } from '@/common/enums';
import ApiService from '@/services';
import { showNotification } from '@/utils/function';

export const config = {
  api: {
    bodyParser: true,
  },
};
export default async function handler(req, res) {
  try {
    const { params } = req.body.body;
    const response = await ApiService.get(`/school/filter-school`, {
      params: params,
    });
    const data = response.data;
    if (data?.code === 200) {
      res.status(200).json({ data });
    } else {
      showNotification(ETypeNotification.ERROR, data?.message);
    }
  } catch (error) {
    res.status(500).json({ error: 'Internal Server Error' });
  }
  res.end();
}
